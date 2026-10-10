@extends('layouts.app')

@section('title', $project->title . ' | Portfolio Andika Amansyah')

@section('content')
<section class="py-5" style="padding-top: calc(var(--navbar-height) + 2rem) !important;">
    <div class="container" style="max-width: 900px;">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('portfolio.index') }}" class="text-subtle">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portfolio.index') }}#projects" class="text-subtle">Projects</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">{{ $project->title }}</li>
            </ol>
        </nav>

        <div class="glass-card p-4 p-md-5">
            <span class="badge bg-primary bg-opacity-20 text-primary mb-2 font-mono">{{ $project->category }}</span>
            <h1 class="display-6 fw-bold text-white font-heading mb-3">{{ $project->title }}</h1>
            <p class="lead text-subtle mb-4">{{ $project->summary }}</p>

            @if($project->image)
                <div class="rounded-4 overflow-hidden mb-4 border border-subtle shadow-lg">
                    <img src="{{ $project->image }}" alt="{{ $project->title }}" class="img-fluid w-100" style="max-height: 420px; object-fit: cover;">
                </div>
            @endif

            <div class="d-flex flex-wrap gap-2 mb-4 pt-2">
                @if(is_array($project->technologies))
                    @foreach($project->technologies as $tech)
                        <span class="tech-tag py-1 px-3 fs-6">{{ $tech }}</span>
                    @endforeach
                @endif
            </div>

            <hr class="border-subtle my-4">

            <h2 class="h5 fw-bold text-white font-heading mb-3">Deskripsi &amp; Arsitektur Sistem</h2>
            <div class="text-subtle mb-5" style="line-height: 1.8; white-space: pre-line;">
                {{ $project->description }}
            </div>

            <div class="d-flex flex-wrap gap-3 pt-3 border-top border-subtle">
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline-custom">
                        <i class="bi bi-github me-1"></i> Repositori GitHub
                    </a>
                @endif
                @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="btn btn-primary-custom">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Live Demo / Preview
                    </a>
                @endif
                <a href="{{ route('portfolio.index') }}#projects" class="btn btn-outline-secondary ms-auto">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Portfolio
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
