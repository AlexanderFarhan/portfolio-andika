<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Http\Requests\ExperienceRequest;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('order', 'asc')->get();
        return view('admin.experience.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experience.create');
    }

    public function store(ExperienceRequest $request)
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (Experience::max('order') + 1);

        Experience::create($data);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Pengalaman baru berhasil ditambahkan.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experience.edit', compact('experience'));
    }

    public function update(ExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Data pengalaman berhasil diperbarui.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Data pengalaman berhasil dihapus.');
    }
}
