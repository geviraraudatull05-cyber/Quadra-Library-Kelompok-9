<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quadra Library</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/png">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        :root {
            --pink-primary: #e84393;
            --pink-secondary: #fd79a8;
            --pink-accent: #ff9ecb;
            --pink-light: #ffeff7;
            --pink-lighter: #fff8fb;
            --pink-dark: #c44569;
            --pink-gradient: linear-gradient(135deg, #e84393 0%, #fd79a8 50%, #ff9ecb 100%);
            --pink-gradient-reverse: linear-gradient(135deg, #ff9ecb 0%, #fd79a8 50%, #e84393 100%);
            --shadow-pink: 0 10px 30px rgba(232, 67, 147, 0.15);
            --shadow-pink-hover: 0 15px 35px rgba(232, 67, 147, 0.25);
        }

        body {
            background: linear-gradient(135deg, #fef9fb 0%, #fff8fb 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ==================== NAVBAR ==================== */
        .navbar-auth {
            background: white;
            box-shadow: var(--shadow-pink);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand-auth {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .navbar-logo-container {
            width: 50px;
            height: 50px;
            background: var(--pink-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(232, 67, 147, 0.3);
        }

        .navbar-logo-container img {
            width: 32px;
            height: 32px;
            filter: brightness(0) invert(1);
        }

        .navbar-brand-text {
            font-size: 24px;
            font-weight: 800;
            background: var(--pink-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }

        .nav-link-auth {
            color: #555 !important;
            font-weight: 600;
            padding: 8px 16px !important;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .nav-link-auth:hover {
            color: var(--pink-primary) !important;
            background-color: var(--pink-lighter);
        }

        .nav-link-auth.active {
            color: white !important;
            background: var(--pink-gradient);
        }

        /* ==================== AUTH CONTAINER ==================== */
        .auth-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23e84393' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .auth-card {
            background: white;
            border-radius: 24px;
            box-shadow: var(--shadow-pink);
            border: 1px solid rgba(232, 67, 147, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-header {
            background: var(--pink-gradient);
            padding: 35px 30px;
            text-align: center;
            color: white;
        }

        .auth-header-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 30px;
        }

        .auth-header h2 {
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 28px;
        }

        .auth-header p {
            opacity: 0.9;
            margin: 0;
            font-size: 15px;
        }

        .auth-body {
            padding: 35px 30px;
        }

        /* ==================== FORM STYLES ==================== */
        .form-label-auth {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control-auth {
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control-auth:focus {
            border-color: var(--pink-accent);
            box-shadow: 0 0 0 0.25rem rgba(232, 67, 147, 0.15);
        }

        .input-group-auth {
            position: relative;
        }

        .input-group-auth .form-control-auth {
            padding-right: 45px;
        }

        .input-group-auth .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            z-index: 5;
        }

        .form-text-auth {
            font-size: 13px;
            color: #888;
        }

        /* ==================== BUTTONS ==================== */
        .btn-auth-primary {
            background: var(--pink-gradient);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-auth-primary:hover {
            background: var(--pink-gradient-reverse);
            transform: translateY(-2px);
            box-shadow: var(--shadow-pink-hover);
        }

        .btn-auth-outline {
            background: transparent;
            color: var(--pink-primary);
            border: 2px solid var(--pink-primary);
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-auth-outline:hover {
            background: var(--pink-primary);
            color: white;
            transform: translateY(-2px);
        }

        /* ==================== LINKS ==================== */
        .auth-link {
            color: var(--pink-primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .auth-link:hover {
            color: var(--pink-dark);
            gap: 8px;
        }

        .auth-footer {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(232, 67, 147, 0.1);
            text-align: center;
        }

        .back-to-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--pink-primary);
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .back-to-home:hover {
            background: var(--pink-lighter);
            gap: 12px;
        }

        /* ==================== FOOTER PREMIUM (SAMA DENGAN LAYOUT UTAMA) ==================== */
        .footer-premium {
            background: white;
            padding: clamp(2rem, 4vw, 3rem) 0 clamp(1rem, 2vw, 1.5rem);
            margin-top: auto;
            position: relative;
        }

        .footer-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--pink-gradient);
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: clamp(1.5rem, 3vw, 2.5rem);
            margin-bottom: 2rem;
        }

        .footer-brand {
            grid-column: span 1;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .footer-logo-icon {
            width: 40px;
            height: 40px;
            background: var(--pink-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-logo-icon img {
            width: 22px;
            height: 22px;
            filter: brightness(0) invert(1);
        }

        .footer-brand-name {
            font-size: clamp(1.125rem, 2vw, 1.375rem);
            font-weight: 800;
            background: var(--pink-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .footer-description {
            color: #666;
            font-size: clamp(0.813rem, 1.2vw, 0.875rem);
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            gap: 0.625rem;
            flex-wrap: wrap;
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--pink-lighter);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--pink-primary);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-link:hover {
            background: var(--pink-gradient);
            color: white;
            transform: translateY(-3px);
        }

        .footer-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: clamp(1.5rem, 3vw, 2rem);
            grid-column: span 2;
        }

        .footer-column h5 {
            color: var(--pink-dark);
            font-size: clamp(0.938rem, 1.5vw, 1.063rem);
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-column h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--pink-gradient);
            border-radius: 3px;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin-bottom: 0.625rem;
        }

        .footer-column ul li a {
            color: #666;
            font-size: clamp(0.813rem, 1.2vw, 0.875rem);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .footer-column ul li a:hover {
            color: var(--pink-primary);
            transform: translateX(5px);
        }

        .footer-column ul li a i {
            font-size: 0.75rem;
            width: 16px;
            flex-shrink: 0;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(232, 67, 147, 0.1);
            color: #888;
            font-size: clamp(0.75rem, 1.2vw, 0.875rem);
        }

        .footer-bottom a {
            color: var(--pink-primary);
            font-weight: 600;
        }

        .footer-bottom a:hover {
            text-decoration: underline !important;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 768px) {
            .navbar-brand-text {
                font-size: 20px;
            }

            .auth-card {
                margin: 0 15px;
            }

            .auth-header, .auth-body {
                padding: 25px 20px;
            }

            .footer-links {
                grid-template-columns: repeat(2, 1fr);
                grid-column: span 1;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand-text {
                display: none;
            }

            .auth-header h2 {
                font-size: 24px;
            }

            .auth-header-icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .footer-links {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 375px) {
            .footer-links {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    {{-- ==================== NAVBAR ==================== --}}
    <nav class="navbar navbar-expand-lg navbar-auth">
        <div class="container">
            <a class="navbar-brand-auth" href="/">
                <div class="navbar-logo-container">
                    <img src="{{ asset('assets/logo2.png') }}" alt="Quadra Library Logo">
                </div>
                <span class="navbar-brand-text">Quadra Library</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAuth">
                <i class="fas fa-bars" style="color: var(--pink-primary);"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarAuth">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link-auth {{ request()->is('/') ? 'active' : '' }}" href="/">
                            <i class="fas fa-home me-2"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-auth {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-auth {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ==================== AUTH CONTENT ==================== --}}
    <div class="auth-wrapper">
        <div class="auth-card">
            {{-- Header --}}
            <div class="auth-header">
                <div class="auth-header-icon">
                    @if(request()->is('login'))
                        <i class="fas fa-sign-in-alt"></i>
                    @elseif(request()->is('register'))
                        <i class="fas fa-user-plus"></i>
                    @elseif(request()->is('forgot-password'))
                        <i class="fas fa-key"></i>
                    @else
                        <i class="fas fa-book"></i>
                    @endif
                </div>
                <h2>
                    @if(request()->is('login'))
                        Welcome Back
                    @elseif(request()->is('register'))
                        Create Account
                    @elseif(request()->is('forgot-password'))
                        Reset Password
                    @else
                        Quadra Library
                    @endif
                </h2>
                <p>
                    @if(request()->is('login'))
                        Sign in to your Quadra Library account
                    @elseif(request()->is('register'))
                        Join Quadra Library community
                    @elseif(request()->is('forgot-password'))
                        Recover your account password
                    @else
                        Your knowledge sanctuary
                    @endif
                </p>
            </div>

            {{-- Body --}}
            <div class="auth-body">
                {{-- SLOT — DIISI OLEH LOGIN / REGISTER / FORGOT --}}
                {{ $slot }}

                {{-- Additional Links --}}
                <div class="mt-4 text-center">
                    @if(request()->is('login'))
                        <p class="mb-2">
                            <a href="{{ route('password.request') }}" class="auth-link">
                                <i class="fas fa-key"></i> Forgot your password?
                            </a>
                        </p>
                        <p class="mb-0">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="auth-link">
                                <i class="fas fa-user-plus"></i> Register here
                            </a>
                        </p>
                    @elseif(request()->is('register'))
                        <p class="mb-0">
                            Already have an account?
                            <a href="{{ route('login') }}" class="auth-link">
                                <i class="fas fa-sign-in-alt"></i> Sign in here
                            </a>
                        </p>
                    @elseif(request()->is('forgot-password'))
                        <p class="mb-0">
                            <a href="{{ route('login') }}" class="auth-link">
                                <i class="fas fa-arrow-left"></i> Back to login
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== FOOTER PREMIUM ==================== --}}
    <footer class="footer-premium">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            <img src="{{ asset('assets/logo2.png') }}" alt="Quadra Library">
                        </div>
                        <span class="footer-brand-name">Quadra Library</span>
                    </div>
                    <p class="footer-description">
                        Quadra Library dirancang untuk membantu siswa dan petugas perpustakaan dalam pencarian, pengelolaan, serta peminjaman buku dengan tampilan antarmuka yang elegan dan pengalaman pengguna yang maksimal.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-links">
                    <div class="footer-column">
                        <h5>Navigasi Cepat</h5>
                        <ul>
                            <li><a href="/"><i class="fas fa-home"></i> Home</a></li>
                            <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a></li>
                            <li><a href="{{ route('password.request') }}"><i class="fas fa-key"></i> Forgot Password</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h5>Kontak Kami</h5>
                        <ul>
                            <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jl. Pendidikan No. 123, Jakarta</a></li>
                            <li><a href="mailto:info@quadralibrary.com"><i class="fas fa-envelope"></i> info@quadralibrary.com</a></li>
                            <li><a href="tel:+62123456789"><i class="fas fa-phone"></i> (021) 1234-5678</a></li>
                            <li><a href="#"><i class="fas fa-clock"></i> Buka: Senin - Jumat, 08:00 - 17:00</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h5>Tentang</h5>
                        <ul>
                            <li><a href="#"><i class="fas fa-info-circle"></i> Tentang Kami</a></li>
                            <li><a href="#"><i class="fas fa-book"></i> Fitur Perpustakaan</a></li>
                            <li><a href="#"><i class="fas fa-users"></i> Tim Pengembang</a></li>
                            <li><a href="#"><i class="fas fa-question-circle"></i> Bantuan & FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Quadra Library. All rights reserved. |
                    <a href="#">Privacy Policy</a> |
                    <a href="#">Terms of Service</a>
                </p>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-password');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Set active nav link
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link-auth');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // Animasi untuk footer links
            const footerLinks = document.querySelectorAll('.footer-column ul li a');
            footerLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });

                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>
