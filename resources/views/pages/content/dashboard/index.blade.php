@extends('pages.content.index')

@section('main')
    @php
        $role = Auth::user()->role;
        $name = ucfirst(auth()->user()->name);
    @endphp

    <div class="row align-items-center"
         style="background: #2575fc; border-radius: 32px; padding: 48px 40px; box-shadow: 0 4px 24px rgba(37,117,252,0.08); min-height: 320px;">
        <div class="col-12 col-md-7 text-start mb-4 mb-md-0" style="color: #fff;">
            <div style="background:rgba(255,255,255,0.18);display:inline-block;padding:10px 28px;border-radius:16px;font-weight:700;font-size:1.25rem;margin-bottom:18px;">
                Halo, {{ $name }}!
            </div>
            <div style="font-size:2.5rem;font-weight:800;line-height:1.1;margin-bottom:12px;">
                @if($role === 'admin')
                    Siap Untuk Mengelola Sistem?
                @elseif($role === 'dokter')
                    Siap Untuk Melayani Pasien?
                @elseif($role === 'pasien')
                    Siap Untuk Konsultasi Kesehatan?
                @else
                    Selamat Datang di Dashboard!
                @endif
            </div>
            <div style="font-size:1.15rem;font-weight:400;opacity:.95;">
                @if($role === 'admin')
                    Kelola data pengguna, dokter, dan pasien dengan mudah melalui menu di samping.
                @elseif($role === 'dokter')
                    Cek jadwal, data pasien, dan konsultasi Anda hari ini.
                @elseif($role === 'pasien')
                    Buat janji, konsultasi, dan lihat riwayat kesehatan Anda di sini.
                @else
                    Silakan gunakan menu di samping untuk navigasi.
                @endif
            </div>
        </div>
        <div class="col-12 col-md-5 text-center">
            <img src="{{ asset('assets/img/spot-illustrations/auth.png') }}"
                 alt="ilustration"
                 class="img-fluid"
                 style="max-width: 320px; width: 80%; min-width: 180px;">
        </div>
    </div>
@endsection
