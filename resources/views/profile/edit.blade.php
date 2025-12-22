@extends('layouts.app')

@section('content')

<style>
    /* ========== ANIMATION ========== */
    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-animate {
        animation: fadeSlide 0.6s ease both;
    }

    .profile-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 12px 28px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        animation-delay: var(--delay);
    }

    .profile-header {
        background: linear-gradient(135deg, #ff4f9a, #ff9ecb);
        color: white;
        padding: 20px 25px;
        border-radius: 18px 18px 0 0;
        font-weight: 700;
        font-size: 18px;
    }

    .profile-body {
        padding: 25px;
    }

    .profile-divider {
        height: 1px;
        background: #f1f1f1;
        margin: 30px 0;
    }
</style>

<div class="container py-4">

    {{-- TITLE --}}
    <div class="mb-4 profile-animate" style="--delay: 0s">
        <h3 class="fw-bold mb-1">⚙️ Pengaturan Akun</h3>
        <p class="text-muted">
            Kelola informasi akun, keamanan, dan preferensi Anda
        </p>
    </div>

    {{-- PROFILE INFORMATION --}}
    <div class="profile-card profile-animate" style="--delay: 0.1s">
        <div class="profile-header">
            👤 Informasi Profil
        </div>
        <div class="profile-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- UPDATE PASSWORD --}}
    <div class="profile-card profile-animate" style="--delay: 0.2s">
        <div class="profile-header">
            🔒 Keamanan Akun
        </div>
        <div class="profile-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- DELETE ACCOUNT --}}
    <div class="profile-card profile-animate" style="--delay: 0.3s">
        <div class="profile-header bg-danger">
            ⚠️ Zona Berbahaya
        </div>
        <div class="profile-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection
