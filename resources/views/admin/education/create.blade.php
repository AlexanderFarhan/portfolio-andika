@extends('admin.layouts.admin')

@section('title', 'Tambah Riwayat Pendidikan')
@section('page-title', 'Tambah Riwayat Pendidikan')

@section('content')
<div class="glass-card p-4" style="max-width: 750px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Input Pendidikan Baru</h2>
        <a href="{{ route('admin.educations.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.educations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label small fw-semibold">Nama Institusi / Universitas</label>
            <input type="text" name="institution" class="form-control form-control-custom" value="{{ old('institution') }}" placeholder="Contoh: Universitas Bina Sarana Informatika (UBSI)" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Gelar / Jenjang</label>
                <input type="text" name="degree" class="form-control form-control-custom" value="{{ old('degree') }}" placeholder="S1 - Teknologi Informasi" required>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Jurusan / Konsentrasi</label>
                <input type="text" name="field_of_study" class="form-control form-control-custom" value="{{ old('field_of_study') }}" placeholder="Software Engineering & Networking">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Tahun Mulai</label>
                <input type="text" name="start_year" class="form-control form-control-custom" value="{{ old('start_year', '2022') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Tahun Selesai</label>
                <input type="text" name="end_year" class="form-control form-control-custom" value="{{ old('end_year', 'Sekarang') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">IPK / Nilai Rata-rata</label>
                <input type="text" name="gpa" class="form-control form-control-custom" value="{{ old('gpa') }}" placeholder="3.85 / 4.00">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Deskripsi Aktivitas / Capaian Akademik</label>
            <textarea name="description" rows="3" class="form-control form-control-custom">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-semibold">Urutan Urut</label>
            <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', 1) }}" style="max-width: 150px;">
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-check2-circle me-1"></i> Simpan Data Pendidikan
        </button>
    </form>
</div>
@endsection
