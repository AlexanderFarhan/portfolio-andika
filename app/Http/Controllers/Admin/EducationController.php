<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Http\Requests\EducationRequest;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order', 'asc')->get();
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(EducationRequest $request)
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (Education::max('order') + 1);

        Education::create($data);

        return redirect()->route('admin.educations.index')
            ->with('success', 'Data riwayat pendidikan berhasil ditambahkan.');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(EducationRequest $request, Education $education)
    {
        $education->update($request->validated());

        return redirect()->route('admin.educations.index')
            ->with('success', 'Data riwayat pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.educations.index')
            ->with('success', 'Data riwayat pendidikan berhasil dihapus.');
    }
}
