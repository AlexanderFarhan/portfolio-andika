<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order', 'asc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = !empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['title']);
        
        // Split comma-separated technologies into array
        $techArray = array_map('trim', explode(',', $data['technologies']));
        $data['technologies'] = array_filter($techArray);

        $data['is_featured'] = $request->has('is_featured');
        $data['order'] = $data['order'] ?? (Project::max('order') + 1);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('projects', 'public');
            $data['image'] = '/storage/' . $path;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project portofolio baru berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $data['slug'] = !empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['title']);

        $techArray = array_map('trim', explode(',', $data['technologies']));
        $data['technologies'] = array_filter($techArray);

        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image_file')) {
            if ($project->image && !str_starts_with($project->image, '/images/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $project->image));
            }
            $path = $request->file('image_file')->store('projects', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Data project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->image && !str_starts_with($project->image, '/images/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $project->image));
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
