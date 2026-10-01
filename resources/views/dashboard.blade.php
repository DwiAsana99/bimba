@extends('layouts.app')

@section('content')

    <!-- Breadcrumb -->
    <x-breadcrumb :items="[['title' => 'Dashboard Overview']]" />

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard Overview</h1>
            <p class="text-sm text-slate-500">Selamat datang kembali di Sistem Manajemen Operasional Les BIMBA</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="btn bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 shadow-2xs font-medium text-xs rounded-xl px-4 py-2.5">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Unduh Laporan Ringkas
            </button>
            <button class="btn bg-bimba-maroon hover:bg-red-800 text-white shadow-md font-medium text-xs rounded-xl px-4 py-2.5 border-none">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Tagihan Bulanan
            </button>
        </div>
    </div>

    <!-- KPI Summary Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Total Cabang -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Cabang</span>
                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-bimba-navy">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-900">12</span>
                <span class="text-xs font-semibold text-emerald-600">Aktif</span>
            </div>
            <div class="mt-2 text-xs text-slate-400">Tersebar di seluruh wilayah operasional</div>
        </div>

        <!-- Murid Aktif -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Murid Aktif</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-900">1,485</span>
                <span class="text-xs font-semibold text-emerald-600">+8% bulan ini</span>
            </div>
            <div class="mt-2 text-xs text-slate-400">Total terdaftar aktif les</div>
        </div>

        <!-- Terkumpul Bulan Ini -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pembayaran Terkumpul</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-extrabold text-slate-900">Rp 142.5M</span>
                <span class="text-xs font-semibold text-emerald-600">72% Paid</span>
            </div>
            <div class="mt-2 text-xs text-slate-400">Periode: {{ date('F Y') }}</div>
        </div>

        <!-- Overdue / Tunggakan -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tunggakan (Overdue)</span>
                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-bimba-strawberry">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-extrabold text-bimba-maroon">Rp 28.4M</span>
                <span class="text-xs font-semibold text-bimba-strawberry">48 Siswa</span>
            </div>
            <div class="mt-2 text-xs text-slate-400">Melewati tanggal jatuh tempo</div>
        </div>

    </div>

    <!-- Theme & UI Demonstration Box -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs mb-8">
        <h2 class="text-base font-bold text-slate-900 mb-2">Instiki Brand Guideline Theme System</h2>
        <p class="text-xs text-slate-500 mb-4">Verifikasi visual token warna resmi untuk sistem BIMBA:</p>
        
        <div class="flex flex-wrap gap-4 items-center">
            <button class="btn bg-bimba-maroon text-white border-none hover:bg-red-800">
                Maroon (#A20404) - Primary
            </button>
            <button class="btn bg-bimba-navy text-white border-none hover:bg-slate-900">
                Navy Blue (#192A54) - Secondary
            </button>
            <button class="btn bg-bimba-golden text-slate-900 border-none hover:bg-amber-500">
                Golden Hour (#FFAD01) - Warning
            </button>
            <button class="btn bg-bimba-strawberry text-white border-none hover:bg-red-600">
                Strawberry (#FF0100) - Danger
            </button>
        </div>
    </div>

@endsection
