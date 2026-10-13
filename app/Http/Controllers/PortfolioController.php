<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\SocialLink;
use App\Models\ContactMessage;
use App\Http\Requests\ContactMessageRequest;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display the public portfolio page with all sections.
     */
    public function index()
    {
        $profile = Profile::first();
        $educations = Education::orderBy('order', 'asc')->orderBy('start_year', 'desc')->get();
        $experiences = Experience::orderBy('order', 'asc')->get();
        $skills = Skill::orderBy('order', 'asc')->get();
        $skillsByCategory = $skills->groupBy('category');
        $projects = Project::orderBy('order', 'asc')->get();
        $certificates = Certificate::orderBy('order', 'asc')->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('portfolio.index', compact(
            'profile',
            'educations',
            'experiences',
            'skills',
            'skillsByCategory',
            'projects',
            'certificates',
            'socialLinks'
        ));
    }

    /**
     * Store incoming contact message.
     */
    public function contact(ContactMessageRequest $request)
    {
        $message = ContactMessage::create($request->validated());

        if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest' || $request->acceptsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda berhasil dikirim secara realtime! Terima kasih telah menghubungi saya.',
                'data' => [
                    'id' => $message->id,
                    'name' => $message->name,
                ]
            ]);
        }

        return redirect('/')
            ->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi saya.');
    }

    /**
     * View or Download CV.
     */
    public function downloadCv()
    {
        $profile = Profile::first();

        // If custom PDF CV exists, stream/download it
        if ($profile && !empty($profile->resume_pdf)) {
            $resumeDiskPath = ltrim(str_replace('/storage/', '', $profile->resume_pdf), '/');

            // 1. Check local storage disk
            try {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($resumeDiskPath)) {
                    return \Illuminate\Support\Facades\Storage::disk('public')->response($resumeDiskPath, 'CV_Andika_Amansyah.pdf', [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; filename="CV_Andika_Amansyah.pdf"',
                    ]);
                }
            } catch (\Throwable $e) {
                // Fall through to database
            }

            // 2. Check persistent MediaFile in database
            try {
                $media = \App\Models\MediaFile::where('disk_path', $resumeDiskPath)->first();
                if ($media && !empty($media->payload)) {
                    $binary = base64_decode($media->payload);
                    return response($binary, 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Length' => strlen($binary),
                        'Content-Disposition' => 'inline; filename="' . ($media->filename ?: 'CV_Andika_Amansyah.pdf') . '"',
                        'Cache-Control' => 'public, max-age=86400, stale-while-revalidate=604800',
                    ]);
                }
            } catch (\Throwable $e) {
                // Fall through to HTML template
            }
        }

        $educations = Education::orderBy('order', 'asc')->get();
        $experiences = Experience::orderBy('order', 'asc')->get();
        $skills = Skill::orderBy('order', 'asc')->get();
        $projects = Project::where('is_featured', true)->orderBy('order', 'asc')->get();
        $certificates = Certificate::orderBy('order', 'asc')->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('portfolio.cv', compact(
            'profile',
            'educations',
            'experiences',
            'skills',
            'projects',
            'certificates',
            'socialLinks'
        ));
    }
}
