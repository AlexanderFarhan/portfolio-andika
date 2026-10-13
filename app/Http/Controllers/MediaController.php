<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class MediaController extends Controller
{
    /**
     * Serve stored media files seamlessly across local and serverless Vercel environments.
     *
     * @param string $path
     * @return Response
     */
    public function serve(string $path)
    {
        $cleanPath = ltrim($path, '/');

        // 1. Check if file is available on local filesystem disk
        try {
            if (Storage::disk('public')->exists($cleanPath)) {
                return Storage::disk('public')->response($cleanPath);
            }
        } catch (\Throwable $e) {
            // Fall back to database
        }

        // 2. Retrieve from database-backed media storage
        try {
            $media = MediaFile::where('disk_path', $cleanPath)->first();
            if ($media && !empty($media->payload)) {
                $binary = base64_decode($media->payload);
                $mimeType = $media->mime_type ?: 'application/octet-stream';
                $isPdf = str_contains($mimeType, 'pdf');
                $isImage = str_starts_with($mimeType, 'image/');
                $disposition = ($isPdf || $isImage) ? 'inline' : 'attachment';

                // Attempt to cache in /tmp if available for high-speed subsequent hits
                if (is_dir('/tmp/storage/app/public')) {
                    @file_put_contents('/tmp/storage/app/public/' . $cleanPath, $binary);
                }

                return response($binary, 200, [
                    'Content-Type' => $mimeType,
                    'Content-Length' => strlen($binary),
                    'Content-Disposition' => $disposition . '; filename="' . ($media->filename ?: basename($cleanPath)) . '"',
                    'Cache-Control' => 'public, max-age=86400, stale-while-revalidate=604800',
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('MediaController::serve error: ' . $e->getMessage());
        }

        abort(404, 'Berkas media tidak ditemukan.');
    }
}
