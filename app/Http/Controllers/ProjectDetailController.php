<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectDetailController extends Controller
{
    /**
     * Show single project detail.
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json($project);
        }

        return view('portfolio.project-detail', compact('project'));
    }
}
