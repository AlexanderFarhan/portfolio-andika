<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Http\Requests\CertificateRequest;
use App\Services\MediaStorageService;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('order', 'asc')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(CertificateRequest $request)
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (Certificate::max('order') + 1);

        if ($request->hasFile('image_file')) {
            $data['image'] = MediaStorageService::store($request->file('image_file'), 'certificates');
        }

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Sertifikat baru berhasil ditambahkan.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $data = $request->validated();

        if ($request->hasFile('image_file')) {
            MediaStorageService::delete($certificate->image);
            $data['image'] = MediaStorageService::store($request->file('image_file'), 'certificates');
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Data sertifikat berhasil diperbarui.');
    }

    public function destroy(Certificate $certificate)
    {
        MediaStorageService::delete($certificate->image);
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil dihapus.');
    }
}
