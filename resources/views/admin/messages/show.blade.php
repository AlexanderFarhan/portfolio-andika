@extends('admin.layouts.admin')

@section('title', 'Detail Pesan Kontak')
@section('page-title', 'Detail Pesan Masuk')

@section('content')
<div class="glass-card p-4" style="max-width: 800px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom border-subtle">
        <div>
            <h2 class="h5 fw-bold mb-1 font-heading">{{ $message->subject }}</h2>
            <div class="small text-subtle">
                Diterima pada: {{ $message->created_at->format('l, d F Y - H:i:s') }}
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-custom">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Inbox
            </a>
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash me-1"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Sender Details Card -->
    <div class="p-3 rounded-3 bg-secondary bg-opacity-10 border border-subtle mb-4">
        <div class="row g-3">
            <div class="col-sm-6">
                <small class="text-subtle d-block">Nama Pengirim:</small>
                <div class="fw-bold">{{ $message->name }}</div>
            </div>
            <div class="col-sm-6">
                <small class="text-subtle d-block">Alamat Email:</small>
                <a href="mailto:{{ $message->email }}?subject=Re:%20{{ urlencode($message->subject) }}" class="fw-semibold text-primary">
                    <i class="bi bi-envelope me-1"></i>{{ $message->email }}
                </a>
            </div>
        </div>
    </div>

    <!-- Message Content Body -->
    <div class="mb-4">
        <h3 class="h6 fw-semibold text-subtle mb-2">Isi Pesan:</h3>
        <div class="p-3 rounded-3 bg-dark border border-subtle" style="white-space: pre-line; line-height: 1.8;">
            {{ $message->message }}
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex gap-2 pt-2 border-top border-subtle">
        <a href="mailto:{{ $message->email }}?subject=Re:%20{{ urlencode($message->subject) }}" class="btn btn-primary-custom">
            <i class="bi bi-reply-fill me-1"></i> Balas via Email ({{ $message->email }})
        </a>
        <a href="https://wa.me/?text={{ urlencode('Halo ' . $message->name . ', saya Andika Amansyah. Menanggapi pesan Anda perihal ' . $message->subject) }}" target="_blank" class="btn btn-outline-success">
            <i class="bi bi-whatsapp me-1"></i> Hubungi WhatsApp
        </a>
    </div>
</div>
@endsection
