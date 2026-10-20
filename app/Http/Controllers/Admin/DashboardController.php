<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    /**
     * Display admin overview dashboard.
     */
    public function index()
    {
        $stats = [
            'projects_count' => Project::count(),
            'featured_projects_count' => Project::where('is_featured', true)->count(),
            'skills_count' => Skill::count(),
            'education_count' => Education::count(),
            'experience_count' => Experience::count(),
            'certificates_count' => Certificate::count(),
            'messages_count' => ContactMessage::count(),
            'unread_messages_count' => ContactMessage::where('is_read', false)->count(),
        ];

        $recentProjects = Project::orderBy('id', 'desc')->take(5)->get();
        $recentMessages = ContactMessage::orderBy('id', 'desc')->take(5)->get();
        $profile = Profile::first();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentMessages', 'profile'));
    }
}
