<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Http\Requests\SocialLinkRequest;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::orderBy('order', 'asc')->get();
        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(SocialLinkRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? (SocialLink::max('order') + 1);

        SocialLink::create($data);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Tautan media sosial berhasil ditambahkan.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(SocialLinkRequest $request, SocialLink $socialLink)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        $socialLink->update($data);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Tautan media sosial berhasil diperbarui.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Tautan media sosial berhasil dihapus.');
    }
}
