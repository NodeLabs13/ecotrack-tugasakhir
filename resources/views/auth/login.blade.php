@extends('layouts.guest')
@section('title', 'Eco Track - Platform Monitoring Proyek Konstruksi')

@section('content')
<div class="flex flex-col lg:flex-row h-full w-full">

    {{-- LEFT HERO PANEL --}}
    <div class="hero-panel w-full lg:w-[55%] flex items-center justify-center px-6 sm:px-10 lg:px-14 py-10 lg:py-0">

        {{-- Decorative dot grid --}}
        <div class="dot-grid"></div>


        {{-- Content --}}
        <div class="relative z-10 w-full max-w-lg mx-auto space-y-8">

            {{-- Brand --}}
            <div class="anim-left delay-1">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-extrabold text-white tracking-tight">Eco<span class="text-emerald-200">Track</span></span>
                </div>
            </div>

            {{-- Headline --}}
            <div class="anim-left delay-2">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight">
                    Pantau Proyek
                    <span class="block text-emerald-200">Lebih Cerdas</span>
                </h1>
                <p class="mt-4 text-base sm:text-lg text-white/70 leading-relaxed max-w-md">
                    Eco Track adalah platform manajemen proyek konstruksi terintegrasi yang memungkinkan Anda memantau progres lapangan secara real-time, mengelola dokumen, dan mengoptimalkan efisiensi tim.
                </p>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 gap-3 anim-left delay-3">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/10 hover:bg-white/15 transition-all duration-300">
                    <div class="text-2xl font-black text-white">99%</div>
                    <div class="text-white/60 text-xs uppercase tracking-wider font-medium mt-0.5">Akurasi Monitoring</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/10 hover:bg-white/15 transition-all duration-300">
                    <div class="text-2xl font-black text-white">Real-time</div>
                    <div class="text-white/60 text-xs uppercase tracking-wider font-medium mt-0.5">Update Progres</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/10 hover:bg-white/15 transition-all duration-300">
                    <div class="text-2xl font-black text-white">150+</div>
                    <div class="text-white/60 text-xs uppercase tracking-wider font-medium mt-0.5">Proyek Terkelola</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/10 hover:bg-white/15 transition-all duration-300">
                    <div class="text-2xl font-black text-white">24/7</div>
                    <div class="text-white/60 text-xs uppercase tracking-wider font-medium mt-0.5">Akses Tanpa Batas</div>
                </div>
            </div>

        </div>
    </div>

    {{-- RIGHT FORM PANEL --}}
    <div class="form-panel w-full lg:w-[45%] flex items-center justify-center px-6 sm:px-8 py-10 lg:py-0">
        <div class="form-container">

            {{-- Form Card --}}
            <div class="anim-scale delay-2">

                {{-- Brand Header --}}
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center gap-2.5 mb-3">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                            <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-extrabold text-slate-800">Eco<span class="text-emerald-600">Track</span></span>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Selamat Datang Kembali</h2>
                    <p class="text-sm text-slate-400 mt-1">Masuk untuk mengakses dashboard proyek Anda</p>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-xl text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="form-input"
                                placeholder="nama@perusahaan.com">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                        <div class="relative">
                            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" name="password" required
                                class="form-input"
                                placeholder="••••••••">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-primary-custom">
                        Masuk Ke Dashboard
                    </button>
                </form>

                {{-- Footer --}}
                <div class="mt-8 pt-6 border-t border-slate-100">
                    <p class="text-center text-sm text-slate-400">
                        Belum punya akun?
                    </p>
                    <div class="flex items-center justify-center gap-4 mt-3">
                        <a href="#" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                            Pelajari Lebih Lanjut
                        </a>
                        <span class="text-slate-200">|</span>
                        <a href="#" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                            Hubungi Kami
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection