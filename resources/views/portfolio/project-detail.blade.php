@extends('layouts.app')

@section('title', $project->title . ' | Studi Kasus Proyek — Andika Amansyah')

@section('content')
<section class="py-5" style="padding-top: calc(var(--navbar-height) + 2rem) !important;">
    <div class="container" style="max-width: 960px;">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('portfolio.index') }}" class="text-subtle text-decoration-none hover-primary"><i class="bi bi-house-door me-1"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portfolio.index') }}#projects" class="text-subtle text-decoration-none hover-primary">Proyek Unggulan</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">{{ $project->title }}</li>
            </ol>
        </nav>

        <div class="glass-card p-4 p-md-5">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <span class="badge bg-secondary-subtle text-secondary-emphasis font-mono" style="font-size: 0.8rem;">{{ $project->category }}</span>
                @if($project->is_featured)
                    <span class="small text-muted font-mono"><i class="bi bi-star-fill text-warning me-1"></i> Proyek Pilihan</span>
                @endif
            </div>

            <h1 class="display-6 fw-bold font-heading mb-3" style="color: var(--text-primary);">{{ $project->title }}</h1>
            <p class="lead text-subtle mb-4" style="line-height: 1.7;">{{ $project->summary }}</p>

            @if($project->image)
                <div class="rounded-4 overflow-hidden mb-4 border border-subtle shadow-lg">
                    <img src="{{ $project->image }}" alt="{{ $project->title }}" class="img-fluid w-100" style="max-height: 440px; object-fit: cover;">
                </div>
            @endif

            <div class="mb-4">
                <h2 class="small fw-bold text-muted text-uppercase font-mono mb-2" style="font-size: 0.75rem;">TEKNOLOGI &amp; TOOLS:</h2>
                <div class="d-flex flex-wrap gap-2">
                    @if(is_array($project->technologies))
                        @foreach($project->technologies as $tech)
                            <span class="tech-tag py-1 px-3 fs-6">{{ $tech }}</span>
                        @endforeach
                    @endif
                </div>
            </div>

            <hr class="border-subtle my-4 opacity-50">

            <h2 class="h5 fw-bold font-heading mb-3" style="color: var(--text-primary);">Deskripsi Solusi &amp; Arsitektur Sistem</h2>
            <div class="text-subtle mb-5" style="line-height: 1.85; white-space: pre-line;">
                {{ $project->description }}
            </div>

            <div class="d-flex flex-wrap gap-3 pt-3 border-top border-subtle align-items-center">
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-custom">
                        <i class="bi bi-github me-1"></i> Repositori GitHub
                    </a>
                @endif
                @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary-custom">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Live Demo / Preview
                    </a>
                @endif
                <a href="{{ route('portfolio.index') }}#projects" class="btn btn-outline-custom ms-auto">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Portofolio
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
