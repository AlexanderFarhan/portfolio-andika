<?php

namespace App\Services;

use App\Models\MediaFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MediaStorageService
{
    /**
     * Store an uploaded file persistently in the database and local disk.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string Public web URL path (e.g. /storage/profile/hash.jpg)
     */
    public static function store(UploadedFile $file, string $folder = 'uploads'): string
    {
        $filename = $file->hashName();
        $diskPath = trim($folder, '/') . '/' . $filename;
        $content = file_get_contents($file->getRealPath());
        $mimeType = $file->getClientMimeType() ?: $file->getMimeType() ?: 'application/octet-stream';
        $originalName = $file->getClientOriginalName();
        $size = $file->getSize();

        // 1. Persist to MediaFile table (guarantees survival on serverless Vercel)
        try {
            MediaFile::updateOrCreate(
                ['disk_path' => $diskPath],
                [
                    'filename' => $originalName,
                    'mime_type' => $mimeType,
                    'size' => $size,
                    'payload' => base64_encode($content),
                ]
            );
        } catch (\Throwable $e) {
            Log::warning('MediaStorageService: Failed writing to media_files table: ' . $e->getMessage());
        }

        // 2. Also attempt to write to local filesystem disk (if writable)
        try {
            Storage::disk('public')->put($diskPath, $content);
        } catch (\Throwable $e) {
            Log::info('MediaStorageService: Storage disk write skipped (likely read-only runtime): ' . $e->getMessage());
        }

        return '/storage/' . $diskPath;
    }

    /**
     * Delete a stored file from both the database and disk.
     *
     * @param string|null $path
     * @return void
     */
    public static function delete(?string $path): void
    {
        if (empty($path)) {
            return;
        }

        // Protect static seed assets from deletion
        if (str_starts_with($path, '/images/') || str_starts_with($path, '/cv/')) {
            return;
        }

        $diskPath = ltrim(str_replace('/storage/', '', $path), '/');

        // Delete from database
        try {
            MediaFile::where('disk_path', $diskPath)->delete();
        } catch (\Throwable $e) {
            Log::warning('MediaStorageService: Failed deleting from media_files: ' . $e->getMessage());
        }

        // Delete from storage disk
        try {
            if (Storage::disk('public')->exists($diskPath)) {
                Storage::disk('public')->delete($diskPath);
            }
        } catch (\Throwable $e) {
            Log::info('MediaStorageService: Failed deleting from storage disk: ' . $e->getMessage());
        }
    }
}
