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
