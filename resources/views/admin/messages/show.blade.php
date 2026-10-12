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
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline delete-form" data-item-name="Pesan dari {{ $message->name }} ({{ $message->subject }})" data-confirm-message="Apakah Anda yakin ingin menghapus pesan ini secara permanen?">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash me-1"></i> Hapus
                </button>
            </form>
        </div>
    </div>

@php
    $emailSubject = 'Re: ' . $message->subject;
    $emailBody = "Halo " . $message->name . ",\n\nTerima kasih telah menghubungi saya melalui formulir kontak portofolio.\n\nMenanggapi pesan Anda perihal \"" . $message->subject . "\":\n\n---\n\"" . $message->message . "\"\n---\n\n\nSalam hangat,\nAndika Amansyah";
    
    $gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($message->email) . '&su=' . urlencode($emailSubject) . '&body=' . urlencode($emailBody);
    $outlookUrl = 'https://outlook.live.com/mail/0/deeplink/compose?to=' . urlencode($message->email) . '&subject=' . urlencode($emailSubject) . '&body=' . urlencode($emailBody);
    $mailtoUrl = 'mailto:' . $message->email . '?subject=' . urlencode($emailSubject) . '&body=' . urlencode($emailBody);
@endphp

    <!-- Sender Details Card -->
    <div class="p-3 rounded-3 bg-secondary bg-opacity-10 border border-subtle mb-4">
        <div class="row g-3">
            <div class="col-sm-6">
                <small class="text-subtle d-block">Nama Pengirim:</small>
                <div class="fw-bold">{{ $message->name }}</div>
            </div>
            <div class="col-sm-6">
                <small class="text-subtle d-block">Alamat Email:</small>
                <a href="{{ $gmailUrl }}" target="_blank" rel="noopener noreferrer" class="fw-semibold text-primary" title="Buka email di Gmail browser">
                    <i class="bi bi-envelope-at me-1"></i>{{ $message->email }}
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
    <div class="d-flex flex-wrap gap-2 pt-3 border-top border-subtle align-items-center">
        <!-- Split Button: Langsung buka Gmail browser dengan email penerima terisi otomatis -->
        <div class="btn-group">
            <a href="{{ $gmailUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary-custom d-inline-flex align-items-center gap-1 shadow-sm" id="replyEmailBtn" title="Buka langsung di Gmail browser (email tujuan terisi otomatis)">
                <i class="bi bi-reply-fill me-1"></i> Balas via Email ({{ $message->email }})
            </a>
            <button type="button" class="btn btn-primary-custom dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" title="Pilihan Layanan Email Browser">
                <span class="visually-hidden">Pilihan Email</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-subtle">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ $gmailUrl }}" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-google text-danger fs-6"></i>
                        <div>
                            <span class="fw-semibold d-block">Gmail Web (Rekomendasi Browser)</span>
                            <small class="text-subtle" style="font-size: 0.75rem;">Langsung buka akun Gmail di tab baru</small>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ $outlookUrl }}" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-microsoft text-primary fs-6"></i>
                        <div>
                            <span class="fw-semibold d-block">Outlook Web</span>
                            <small class="text-subtle" style="font-size: 0.75rem;">Buka di webmail Outlook.com</small>
                        </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ $mailtoUrl }}">
                        <i class="bi bi-envelope-paper text-info fs-6"></i>
                        <div>
                            <span class="fw-semibold d-block">Aplikasi Email Lokal (Mailto)</span>
                            <small class="text-subtle" style="font-size: 0.75rem;">Gunakan aplikasi bawaan Windows/Mac</small>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <a href="https://wa.me/?text={{ urlencode('Halo ' . $message->name . ', saya Andika Amansyah. Menanggapi pesan Anda perihal ' . $message->subject) }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success d-inline-flex align-items-center gap-1">
            <i class="bi bi-whatsapp me-1"></i> Hubungi WhatsApp
        </a>
    </div>
</div>
@endsection
