<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Http\Requests\SkillRequest;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->orderBy('order', 'asc')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(SkillRequest $request)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->has('is_featured');
        $data['order'] = $data['order'] ?? (Skill::max('order') + 1);

        Skill::create($data);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill keahlian baru berhasil ditambahkan.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(SkillRequest $request, Skill $skill)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->has('is_featured');

        $skill->update($data);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Data skill berhasil diperbarui.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Data skill berhasil dihapus.');
    }
}
