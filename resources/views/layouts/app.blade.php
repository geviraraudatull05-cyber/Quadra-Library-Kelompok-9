<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Quadra Library</title>

    {{-- ======================= FAVICON ======================= --}}
    <link rel="icon" href="{{ asset('assets/logo2.png') }}" type="image/png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- QUADRA LIBRARY PREMIUM PINK THEME -->
<style>
    /* ======================= ROOT VARIABLES ======================= */
    :root {
        --pink-primary: #e84393;
        --pink-secondary: #fd79a8;
        --pink-accent: #ff9ecb;
        --pink-light: #ffeff7;
        --pink-lighter: #fff8fb;
        --pink-dark: #c44569;
        --pink-gradient: linear-gradient(135deg, #e84393 0%, #fd79a8 50%, #ff9ecb 100%);
        --pink-gradient-reverse: linear-gradient(135deg, #ff9ecb 0%, #fd79a8 50%, #e84393 100%);
        --shadow-pink: 0 8px 25px rgba(232, 67, 147, 0.15);
        --shadow-pink-hover: 0 15px 35px rgba(232, 67, 147, 0.25);
        --shadow-soft: 0 4px 12px rgba(0, 0, 0, 0.05);
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ======================= RESET & BASE ======================= */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #fef9fb;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(255, 200, 221, 0.15) 0%, transparent 20%),
            radial-gradient(circle at 90% 80%, rgba(253, 121, 168, 0.1) 0%, transparent 20%);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
        font-size: clamp(14px, 1vw, 16px);
        line-height: 1.6;
    }

    a {
        text-decoration: none !important;
        transition: var(--transition-smooth);
    }

    /* ======================= NAVBAR PREMIUM ======================= */
    .navbar-premium {
        background: white;
        box-shadow: var(--shadow-pink);
        padding: 0.75rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: var(--transition-smooth);
    }

    .navbar-premium.scrolled {
        padding: 0.5rem 0;
        box-shadow: 0 8px 20px rgba(232, 67, 147, 0.2);
    }

    .navbar-premium .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(1rem, 3vw, 2rem);
    }

    /* Brand Section */
    .navbar-brand-premium {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-right: auto;
    }

    .navbar-logo-container {
        width: clamp(36px, 5vw, 45px);
        height: clamp(36px, 5vw, 45px);
        background: var(--pink-gradient);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(232, 67, 147, 0.3);
        transition: var(--transition-smooth);
    }

    .navbar-logo-container:hover {
        transform: rotate(10deg) scale(1.05);
    }

    .navbar-logo-container img {
        width: 60%;
        height: 60%;
        filter: brightness(0) invert(1);
        object-fit: contain;
    }

    .navbar-brand-text {
        font-size: clamp(1rem, 2vw, 1.5rem);
        font-weight: 800;
        background: var(--pink-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        letter-spacing: -0.5px;
        white-space: nowrap;
    }

    /* Navbar Toggle */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
        background: var(--pink-lighter);
        border-radius: 8px;
        transition: var(--transition-smooth);
    }

    .navbar-toggler:hover {
        background: var(--pink-light);
        transform: scale(1.05);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(232, 67, 147, 0.2);
    }

    /* Navigation Container */
    .navbar-nav-container {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex: 1;
        gap: 0.5rem;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-item-premium {
        flex-shrink: 0;
    }

    .nav-link-premium {
        color: #555 !important;
        font-weight: 600;
        padding: 0.625rem 1rem !important;
        border-radius: 10px;
        transition: var(--transition-smooth);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
        font-size: clamp(0.8rem, 1.2vw, 0.9rem);
        position: relative;
    }

    .nav-link-premium:hover {
        color: var(--pink-primary) !important;
        background-color: var(--pink-lighter);
        transform: translateY(-2px);
    }

    .nav-link-premium.active {
        color: white !important;
        background: var(--pink-gradient);
        box-shadow: 0 4px 10px rgba(232, 67, 147, 0.3);
    }

    .nav-link-premium i {
        font-size: 0.9em;
        width: 1em;
        text-align: center;
    }

    /* Text Ellipsis - Responsive */
    .text-ellipsis {
        display: inline-block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Favorite Badge */
    .favorite-badge {
        position: relative;
    }

    .favorite-count {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #ff4757;
        color: white;
        font-size: 0.625rem;
        font-weight: 700;
        min-width: 18px;
        height: 18px;
        padding: 0 4px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* User Dropdown */
    .user-dropdown-premium .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 0.625rem;
        padding: 0.5rem 1rem;
        background: var(--pink-lighter);
        border-radius: 10px;
        border: none;
        font-weight: 600;
        color: var(--pink-dark);
        transition: var(--transition-smooth);
        font-size: clamp(0.8rem, 1.2vw, 0.9rem);
    }

    .user-dropdown-premium .dropdown-toggle:hover {
        background: var(--pink-gradient);
        color: white !important;
        transform: translateY(-2px);
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--pink-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
    }

    /* Dropdown Menu */
    .dropdown-menu-premium {
        border-radius: 12px !important;
        border: 1px solid rgba(232, 67, 147, 0.1) !important;
        box-shadow: var(--shadow-pink) !important;
        margin-top: 0.5rem !important;
        min-width: 200px !important;
        padding: 0.5rem !important;
    }

    .dropdown-item-premium {
        padding: 0.625rem 1rem !important;
        color: #555 !important;
        font-weight: 500;
        border-radius: 8px !important;
        margin: 0.25rem 0 !important;
        transition: var(--transition-smooth);
        font-size: 0.875rem;
    }

    .dropdown-item-premium:hover {
        background: var(--pink-lighter) !important;
        color: var(--pink-primary) !important;
        transform: translateX(5px);
    }

    .dropdown-item-premium i {
        width: 20px;
        text-align: center;
        margin-right: 0.5rem;
    }

    /* ======================= BUTTONS ======================= */
    .btn-pink-premium {
        background: var(--pink-gradient);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.625rem 1.25rem;
        font-weight: 600;
        box-shadow: var(--shadow-pink);
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: clamp(0.8rem, 1.2vw, 0.9rem);
    }

    .btn-pink-premium:hover {
        background: var(--pink-gradient-reverse);
        color: white;
        transform: translateY(-3px);
        box-shadow: var(--shadow-pink-hover);
    }

    /* ======================= CONTENT WRAPPER ======================= */
    .content-wrapper-premium {
        flex: 1;
        padding: clamp(1.5rem, 3vw, 2.5rem) 0;
        min-height: calc(100vh - 200px);
    }

    .container {
        max-width: 1400px !important;
        padding: 0 clamp(1rem, 3vw, 2rem) !important;
    }

    /* ======================= MODAL FIXES ======================= */
    /* Pastikan modal backdrop tidak menghalangi */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5) !important;
        z-index: 1040 !important;
    }

    .modal-backdrop.show {
        opacity: 0.5 !important;
    }

    /* Modal utama */
    .modal-premium {
        z-index: 1050 !important;
    }

    .modal-premium .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
        z-index: 1060 !important;
    }

    .modal-premium .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(232, 67, 147, 0.3);
        position: relative;
    }

    .modal-premium .modal-header {
        background: var(--pink-gradient);
        color: white;
        border: none;
        padding: 2rem;
        position: relative;
        text-align: center;
    }

    .modal-premium .modal-header::before {
        content: '';
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .modal-premium .modal-icon {
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: var(--pink-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        z-index: 1;
        box-shadow: 0 5px 15px rgba(232, 67, 147, 0.4);
    }

    .modal-premium .modal-title {
        font-weight: 700;
        font-size: 1.5rem;
        margin: 0;
    }

    .modal-premium .modal-body {
        padding: 3rem 2rem 2rem;
        background: white;
    }

    .modal-premium .service-description {
        color: #666;
        line-height: 1.8;
        margin-bottom: 1.5rem;
        text-align: center;
        font-size: 0.95rem;
    }

    .modal-premium .feature-list {
        list-style: none;
        padding: 0;
        margin: 1.5rem 0;
    }

    .modal-premium .feature-list li {
        padding: 0.75rem 1rem;
        margin-bottom: 0.5rem;
        background: var(--pink-lighter);
        border-radius: 10px;
        border-left: 4px solid var(--pink-primary);
        transition: var(--transition-smooth);
        display: flex;
        align-items: center;
    }

    .modal-premium .feature-list li:hover {
        background: var(--pink-light);
        transform: translateX(5px);
    }

    .modal-premium .feature-list li i {
        color: var(--pink-primary);
        margin-right: 0.75rem;
        width: 20px;
        text-align: center;
        flex-shrink: 0;
    }

    .modal-premium .modal-footer {
        border: none;
        padding: 1rem 2rem 2rem;
        justify-content: center;
        background: white;
    }

    /* PERBAIKAN PENTING: Tombol close yang benar */
    .modal-premium .btn-close {
        background: transparent !important;
        opacity: 1 !important;
        filter: brightness(0) invert(1) !important;
        padding: 0.5rem !important;
        margin: -0.5rem -0.5rem -0.5rem auto !important;
        transition: var(--transition-smooth);
        position: relative;
    }

    .modal-premium .btn-close:hover {
        transform: rotate(90deg);
        opacity: 0.8 !important;
    }

    .modal-premium .btn-close:focus {
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3) !important;
    }

    /* Button Gradient untuk Modal - FIX */
    .btn-gradient-pink {
        background: var(--pink-gradient) !important;
        color: white !important;
        border: none !important;
        padding: 0.75rem 2rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        transition: var(--transition-smooth) !important;
        box-shadow: 0 5px 15px rgba(232, 67, 147, 0.3) !important;
        position: relative;
        overflow: hidden;
        cursor: pointer !important;
        display: inline-block !important;
        text-align: center !important;
        vertical-align: middle !important;
        user-select: none !important;
        border: 1px solid transparent !important;
    }

    .btn-gradient-pink:hover {
        background: var(--pink-gradient-reverse) !important;
        color: white !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(232, 67, 147, 0.4) !important;
    }

    .btn-gradient-pink:active {
        transform: translateY(0) !important;
        box-shadow: 0 3px 10px rgba(232, 67, 147, 0.3) !important;
    }

    .btn-gradient-pink:focus {
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(232, 67, 147, 0.3) !important;
    }

    /* Modal Animation FIX */
    .modal.fade .modal-dialog {
        transform: scale(0.9) translateY(-30px);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .modal.show .modal-dialog {
        transform: scale(1) translateY(0);
        opacity: 1;
    }

    /* Accordion Custom untuk modal FAQ */
    .modal-premium .accordion-button {
        background: var(--pink-lighter) !important;
        color: var(--pink-dark) !important;
        font-weight: 600;
        border: none !important;
        box-shadow: none !important;
        padding: 0.75rem 1rem;
    }

    .modal-premium .accordion-button:not(.collapsed) {
        background: var(--pink-light) !important;
        color: var(--pink-primary) !important;
        box-shadow: none !important;
    }

    .modal-premium .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23e84393'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
    }

    .modal-premium .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23e84393'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
    }

    .modal-premium .accordion-body {
        background: white;
        color: #666;
        line-height: 1.7;
        padding: 1rem;
        border-top: 1px solid rgba(232, 67, 147, 0.1);
    }

    /* Alert dalam modal */
    .modal-premium .alert {
        background: var(--pink-lighter);
        border: none;
        border-radius: 10px;
        padding: 1rem;
        margin-top: 1rem;
        color: var(--pink-dark);
        font-size: 0.875rem;
    }

    .modal-premium .alert i {
        color: var(--pink-primary);
        margin-right: 0.5rem;
    }

    /* Modal khusus untuk FAQ (lebih besar) */
    #modalFaq .modal-dialog {
        max-width: 700px;
    }

    /* ======================= FOOTER ======================= */
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
        transition: var(--transition-smooth);
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
        transition: var(--transition-smooth);
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

    /* ======================= ANIMATIONS ======================= */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ======================= RESPONSIVE BREAKPOINTS ======================= */

    /* Large Desktop (1400px+) */
    @media (min-width: 1400px) {
        .navbar-premium .container-fluid,
        .container {
            max-width: 1320px;
        }
    }

    /* Desktop (1200px - 1399px) */
    @media (min-width: 1200px) and (max-width: 1399.98px) {
        .navbar-nav {
            gap: 0.25rem;
        }

        .nav-link-premium {
            padding: 0.5rem 0.875rem !important;
        }
    }

    /* Tablet Landscape (992px - 1199px) */
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .navbar-nav {
            gap: 0.25rem;
        }

        .nav-link-premium {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.813rem;
        }

        .text-ellipsis {
            max-width: 80px;
        }

        .footer-content {
            grid-template-columns: 1fr;
        }

        .footer-links {
            grid-template-columns: repeat(2, 1fr);
            grid-column: span 1;
        }

        .modal-premium .modal-dialog {
            max-width: 600px;
        }
    }

    /* Tablet Portrait (768px - 991px) */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 0.75rem;
            box-shadow: var(--shadow-pink);
            max-height: 70vh;
            overflow-y: auto;
        }

        .navbar-nav-container {
            width: 100%;
        }

        .navbar-nav {
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }

        .nav-item-premium {
            width: 100%;
        }

        .nav-link-premium {
            justify-content: flex-start;
            width: 100%;
            padding: 0.75rem 1rem !important;
            font-size: 0.938rem;
        }

        .text-ellipsis {
            max-width: none !important;
        }

        .user-dropdown-premium {
            width: 100%;
            margin-left: 0 !important;
        }

        .user-dropdown-premium .dropdown-toggle {
            width: 100%;
            justify-content: flex-start;
        }

        .dropdown-menu-premium {
            width: 100% !important;
            position: static !important;
            transform: none !important;
            margin-top: 0.5rem !important;
        }

        .footer-links {
            grid-template-columns: repeat(2, 1fr);
        }

        .modal-premium .modal-dialog {
            max-width: 90%;
            margin: 1rem auto;
        }

        .btn-gradient-pink {
            padding: 0.625rem 1.75rem !important;
        }
    }

    /* Mobile Landscape (576px - 767px) */
    @media (max-width: 767.98px) {
        .footer-content {
            grid-template-columns: 1fr;
        }

        .footer-links {
            grid-template-columns: 1fr;
            grid-column: span 1;
        }

        .footer-column {
            text-align: left;
        }

        .modal-premium .modal-header {
            padding: 1.5rem;
        }

        .modal-premium .modal-body {
            padding: 2.5rem 1.5rem 1.5rem;
        }

        .modal-premium .modal-title {
            font-size: 1.3rem;
        }

        .modal-premium .feature-list li {
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
        }
    }

    /* Mobile Portrait (< 576px) */
    @media (max-width: 575.98px) {
        body {
            font-size: 14px;
        }

        .navbar-brand-text {
            font-size: 1rem;
        }

        .navbar-logo-container {
            width: 36px;
            height: 36px;
        }

        .nav-link-premium {
            font-size: 0.875rem;
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
        }

        .footer-premium {
            padding: 1.5rem 0 1rem;
        }

        .footer-content {
            gap: 1.5rem;
        }

        .footer-brand-name {
            font-size: 1.125rem;
        }

        .footer-description {
            font-size: 0.813rem;
        }

        .social-link {
            width: 32px;
            height: 32px;
        }

        .modal-premium .modal-icon {
            width: 50px;
            height: 50px;
            bottom: -25px;
        }

        .modal-premium .modal-title {
            font-size: 1.25rem;
        }

        .btn-gradient-pink {
            padding: 0.5rem 1.5rem !important;
            font-size: 0.875rem !important;
        }

        #modalFaq .modal-dialog {
            max-width: 95%;
        }
    }

    /* Extra Small Devices (< 375px) */
    @media (max-width: 374.98px) {
        .navbar-brand-text {
            font-size: 0.875rem;
        }

        .navbar-logo-container {
            width: 32px;
            height: 32px;
        }

        .nav-link-premium {
            padding: 0.625rem 0.875rem !important;
            font-size: 0.813rem;
        }

        .btn-pink-premium {
            padding: 0.5rem 1rem;
            font-size: 0.813rem;
        }

        .footer-links {
            grid-template-columns: 1fr;
        }

        .modal-premium .modal-header {
            padding: 1.25rem;
        }

        .modal-premium .modal-body {
            padding: 2rem 1rem 1rem;
        }

        .modal-premium .modal-footer {
            padding: 0.5rem 1rem 1.5rem;
        }
    }

    /* High Resolution Displays */
    @media (min-resolution: 144dpi) {
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    }

    /* Print Styles */
    @media print {
        .navbar-premium,
        .footer-premium,
        .btn-pink-premium,
        .modal-premium {
            display: none !important;
        }

        body {
            background: white;
        }

        .content-wrapper-premium {
            padding: 0;
        }
    }
</style>
</head>

<body>

{{-- ======================= NAVBAR ======================= --}}
<nav class="navbar navbar-expand-lg navbar-premium" id="mainNavbar">
    <div class="container-fluid">
        {{-- BRAND + LOGO --}}
        <a class="navbar-brand-premium" href="{{ route('dashboard') }}">
            <div class="navbar-logo-container">
                <img src="{{ asset('assets/logo2.png') }}" alt="Logo Quadra Library">
            </div>
            <span class="navbar-brand-text">Quadra Library</span>
        </a>

        <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="color: var(--pink-primary); font-size: 1.3rem;"></i>
        </button>

        {{-- NAVIGATION LINKS --}}
        <div class="collapse navbar-collapse" id="navbarContent">
            <div class="navbar-nav-container">
                <ul class="navbar-nav" id="mainNav">
                    @auth
                        {{-- DASHBOARD (SEMUA USER) --}}
                        <li class="nav-item-premium">
                            <a class="nav-link-premium {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                                <i class="fas fa-home fa-sm"></i> <span class="text-ellipsis">Dashboard</span>
                            </a>
                        </li>

                        {{-- ================= ADMIN ================= --}}
                        @if(auth()->user()->role === 'admin')

                            {{-- KELOLA BUKU --}}
                            <li class="nav-item-premium">
                                <a class="nav-link-premium {{ request()->routeIs('admin.books.*') ? 'active' : '' }}"
                                    href="{{ route('admin.books.index') }}">
                                    <i class="fas fa-book fa-sm"></i> <span class="text-ellipsis">Kelola Buku</span>
                                </a>
                            </li>

                            {{-- KATEGORI BUKU --}}
                            <li class="nav-item-premium">
                                <a class="nav-link-premium {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                                    href="{{ route('admin.categories.index') }}">
                                    <i class="fas fa-tags fa-sm"></i> <span class="text-ellipsis">Kategori</span>
                                </a>
                            </li>

                        @endif

                        {{-- ================= SISWA ================= --}}
                        @if(auth()->user()->role === 'siswa')

                            {{-- JELAJAHI BUKU --}}
                            <li class="nav-item-premium">
                                <a class="nav-link-premium {{ request()->routeIs('books.browse') ? 'active' : '' }}"
                                href="{{ route('books.browse') }}">
                                    <i class="fas fa-search fa-sm"></i> <span class="text-ellipsis">Jelajahi Buku</span>
                                </a>
                            </li>



                        @endif

                        {{-- ================= PROFILE ================= --}}
                        <li class="nav-item-premium dropdown user-dropdown-premium">
                            <a class="nav-link-premium dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="text-ellipsis">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-premium">
                                <li>
                                    <a class="dropdown-item dropdown-item-premium" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-circle"></i> Profil Saya
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider mx-3"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                        @csrf
                                        <a class="dropdown-item dropdown-item-premium text-danger" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                    {{-- TOMBOL UNTUK GUEST --}}
                    @guest
                        <li class="nav-item-premium">
                            <a class="nav-link-premium {{ request()->routeIs('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt fa-sm"></i> <span class="text-ellipsis">Login</span>
                            </a>
                        </li>
                        <li class="nav-item-premium">
                            <a class="btn btn-pink-premium" href="{{ route('register') }}">
                                <i class="fas fa-user-plus fa-sm"></i> <span class="text-ellipsis">Register</span>
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>

{{-- ======================= MAIN CONTENT ======================= --}}
<main class="content-wrapper-premium fade-in">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; border: none; background: var(--pink-lighter); color: var(--pink-dark);">
                <i class="fas fa-check-circle me-2" style="color: var(--pink-primary);"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- CONTENT AREA --}}
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>
</main>

{{-- ======================= FOOTER ======================= --}}
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
                        <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                        @if(auth()->check() && auth()->user()->role === 'siswa')
                            <li><a href="{{ route('books.browse') }}"><i class="fas fa-search"></i> Jelajahi Buku</a></li>

                        @endif
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <li><a href="{{ route('admin.books.index') }}"><i class="fas fa-book"></i> Kelola Buku</a></li>
                            <li><a href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i> Kategori</a></li>
                        @endif
                    </ul>
                </div>

                <div class="footer-column">
                    <h5>Kontak Kami</h5>
                    <ul>
                        <li><a href="https://maps.app.goo.gl/WRb5cx2PvsuWcD7Z9"><i class="fas fa-map-marker-alt"></i> Jl. Ketintang Baru, Surabaya</a></li>
                        <li><a href="mailto:vira@gmail.com"><i class="fas fa-envelope"></i> vira@gmail.com</a></li>
                        <li><a href="tel:+62123456789"><i class="fas fa-phone"></i> (021) 1234-5678</a></li>
                        <li><a href="#"><i class="fas fa-clock"></i> Buka: Senin - Jumat, 08:00 - 17:00</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h5>Layanan</h5>
                    <ul>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalPeminjamanBuku"><i class="fas fa-book-open"></i> Peminjaman Buku</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalRekomendasi"><i class="fas fa-star"></i> Rekomendasi Buku</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalEbook"><i class="fas fa-download"></i> E-Book Download</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalFaq"><i class="fas fa-question-circle"></i> Bantuan & FAQ</a></li>
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

{{-- ======================= MODAL COMPONENTS ======================= --}}

<!-- Modal Peminjaman Buku -->
<div class="modal fade modal-premium" id="modalPeminjamanBuku" tabindex="-1" aria-labelledby="modalPeminjamanBukuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="modalPeminjamanBukuLabel">Peminjaman Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-icon">
                    <i class="fas fa-book-open"></i>
                </div>
            </div>
            <div class="modal-body">
                <p class="service-description">
                    Layanan peminjaman buku perpustakaan yang mudah dan cepat untuk mendukung kegiatan belajar Anda.
                </p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Proses peminjaman instan melalui sistem online</li>
                    <li><i class="fas fa-clock"></i> Durasi peminjaman hingga 14 hari</li>
                    <li><i class="fas fa-redo"></i> Perpanjangan otomatis tersedia</li>
                    <li><i class="fas fa-bell"></i> Notifikasi pengingat pengembalian</li>
                    <li><i class="fas fa-history"></i> Riwayat peminjaman lengkap</li>
                </ul>
                <div class="alert" style="background: var(--pink-lighter); border: none; border-radius: 10px; padding: 1rem;">
                    <i class="fas fa-info-circle" style="color: var(--pink-primary); margin-right: 0.5rem;"></i>
                    <strong>Catatan:</strong> Maksimal 3 buku dapat dipinjam dalam satu waktu.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-pink" data-bs-dismiss="modal">
                    <i class="fas fa-check"></i> Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Rekomendasi Buku -->
<div class="modal fade modal-premium" id="modalRekomendasi" tabindex="-1" aria-labelledby="modalRekomendasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="modalRekomendasiLabel">Rekomendasi Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-icon">
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <div class="modal-body">
                <p class="service-description">
                    Dapatkan rekomendasi buku terbaik yang disesuaikan dengan minat dan preferensi membaca Anda.
                </p>
                <ul class="feature-list">
                    <li><i class="fas fa-robot"></i> Rekomendasi berbasis AI dan riwayat baca</li>
                    <li><i class="fas fa-fire"></i> Buku trending dan populer bulan ini</li>
                    <li><i class="fas fa-award"></i> Koleksi buku pemenang penghargaan</li>
                    <li><i class="fas fa-users"></i> Rekomendasi dari pustakawan ahli</li>
                    <li><i class="fas fa-bookmark"></i> Simpan buku favorit ke wishlist</li>
                </ul>
                <div class="alert" style="background: var(--pink-lighter); border: none; border-radius: 10px; padding: 1rem;">
                    <i class="fas fa-lightbulb" style="color: var(--pink-primary); margin-right: 0.5rem;"></i>
                    <strong>Tips:</strong> Update preferensi membaca Anda untuk rekomendasi lebih akurat!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-pink" data-bs-dismiss="modal">
                    <i class="fas fa-check"></i> Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal E-Book Download -->
<div class="modal fade modal-premium" id="modalEbook" tabindex="-1" aria-labelledby="modalEbookLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="modalEbookLabel">E-Book Download</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-icon">
                    <i class="fas fa-download"></i>
                </div>
            </div>
            <div class="modal-body">
                <p class="service-description">
                    Akses koleksi E-Book digital kapan saja, di mana saja. Belajar tanpa batas!
                </p>
                <ul class="feature-list">
                    <li><i class="fas fa-mobile-alt"></i> Baca di smartphone, tablet, atau laptop</li>
                    <li><i class="fas fa-file-pdf"></i> Format PDF, EPUB, dan MOBI tersedia</li>
                    <li><i class="fas fa-infinity"></i> Akses unlimited tanpa batas waktu</li>
                    <li><i class="fas fa-search"></i> Fitur pencarian dan highlight teks</li>
                    <li><i class="fas fa-sync"></i> Sinkronisasi progress membaca otomatis</li>
                </ul>
                <div class="alert" style="background: var(--pink-lighter); border: none; border-radius: 10px; padding: 1rem;">
                    <i class="fas fa-shield-alt" style="color: var(--pink-primary); margin-right: 0.5rem;"></i>
                    <strong>Keamanan:</strong> E-Book dilindungi DRM untuk mencegah penyalahgunaan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-pink" data-bs-dismiss="modal">
                    <i class="fas fa-check"></i> Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bantuan & FAQ -->
<div class="modal fade modal-premium" id="modalFaq" tabindex="-1" aria-labelledby="modalFaqLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="modalFaqLabel">Bantuan & FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
            </div>
            <div class="modal-body">
                <p class="service-description">
                    Pertanyaan yang sering diajukan dan panduan lengkap penggunaan Quadra Library.
                </p>

                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item" style="border: none; margin-bottom: 0.5rem; border-radius: 10px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <i class="fas fa-user-plus me-2" style="color: var(--pink-primary);"></i>
                                Bagaimana cara mendaftar di Quadra Library?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Klik tombol "Register" di halaman utama, isi form dengan data lengkap, verifikasi email, dan akun Anda siap digunakan!
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border: none; margin-bottom: 0.5rem; border-radius: 10px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <i class="fas fa-clock me-2" style="color: var(--pink-primary);"></i>
                                Berapa lama durasi peminjaman buku?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Durasi standar peminjaman adalah 14 hari. Anda dapat memperpanjang peminjaman hingga 2 kali jika tidak ada antrian peminjam lain.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border: none; margin-bottom: 0.5rem; border-radius: 10px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <i class="fas fa-exclamation-triangle me-2" style="color: var(--pink-primary);"></i>
                                Apa yang terjadi jika terlambat mengembalikan?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Keterlambatan dikenakan denda Rp 1.000 per hari. Setelah 7 hari keterlambatan, akun akan dinonaktifkan sementara hingga buku dikembalikan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border: none; border-radius: 10px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <i class="fas fa-headset me-2" style="color: var(--pink-primary);"></i>
                                Bagaimana cara menghubungi customer service?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Anda dapat menghubungi kami melalui email info@quadralibrary.com, telepon (021) 1234-5678, atau langsung datang ke perpustakaan pada jam operasional.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p style="color: #666; margin-bottom: 1rem;">Masih ada pertanyaan?</p>
                    <a href="mailto:info@quadralibrary.com" class="btn btn-gradient-pink">
                        <i class="fas fa-envelope"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Initialize on DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        // Set active nav link
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link-premium');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.startsWith(href) && href !== '/') {
                link.classList.add('active');
            }

            // Untuk link dashboard khusus
            if (href === '/' && currentPath === '/') {
                link.classList.add('active');
            }
        });

        // Auto-hide scrollbar when not scrolling on mobile
        let scrollTimeout;
        const navbarNav = document.querySelector('.navbar-nav');

        if (navbarNav && window.innerWidth < 1200) {
            navbarNav.addEventListener('scroll', function() {
                clearTimeout(scrollTimeout);
                navbarNav.classList.add('scrolling');

                scrollTimeout = setTimeout(() => {
                    navbarNav.classList.remove('scrolling');
                }, 1000);
            });
        }

        // ================= MODAL FIXES =================
        // Fix untuk semua modal
        const allModals = document.querySelectorAll('.modal-premium');

        allModals.forEach(modal => {
            // Pastikan modal bisa ditutup dengan benar
            modal.addEventListener('show.bs.modal', function() {
                // Hapus modal backdrop yang mungkin masih ada
                const existingBackdrops = document.querySelectorAll('.modal-backdrop');
                existingBackdrops.forEach(backdrop => {
                    backdrop.remove();
                });

                // Nonaktifkan scroll body
                document.body.style.overflow = 'hidden';
                document.body.style.paddingRight = '0px';
            });

            modal.addEventListener('shown.bs.modal', function() {
                // Fokus ke tombol "Mengerti" setelah modal terbuka
                const okButton = this.querySelector('.btn-gradient-pink');
                if (okButton) {
                    setTimeout(() => {
                        okButton.focus();
                    }, 100);
                }
            });

            modal.addEventListener('hide.bs.modal', function(e) {
                // Pastikan event tidak dibatalkan
                if (e && typeof e.preventDefault === 'function') {
                    e.stopPropagation();
                }
            });

            modal.addEventListener('hidden.bs.modal', function() {
                // Aktifkan scroll body kembali
                document.body.style.overflow = 'auto';
                document.body.style.paddingRight = '';

                // Hapus backdrop jika masih ada
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => {
                    backdrop.remove();
                });
            });

            // Handle tombol "Mengerti" dengan benar
            const okButton = modal.querySelector('.btn-gradient-pink');
            if (okButton) {
                okButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Tutup modal dengan benar
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        // Efek klik
                        this.classList.add('clicking');
                        setTimeout(() => {
                            this.classList.remove('clicking');
                            modalInstance.hide();
                        }, 200);
                    }
                });

                // Tambahkan CSS untuk efek klik
                const style = document.createElement('style');
                style.textContent = `
                    .btn-gradient-pink.clicking {
                        transform: scale(0.95) !important;
                        transition: transform 0.1s ease !important;
                    }
                `;
                document.head.appendChild(style);
            }

            // Handle tombol close dengan benar
            const closeButton = modal.querySelector('.btn-close');
            if (closeButton) {
                closeButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                });
            }

            // Cegah modal ditutup saat klik di dalam content
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    const modalInstance = bootstrap.Modal.getInstance(this);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }
            });
        });

        // Handle klik di luar modal (backdrop)
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal-backdrop')) {
                const openModal = document.querySelector('.modal.show');
                if (openModal) {
                    const modalInstance = bootstrap.Modal.getInstance(openModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }
            }
        });

        // Handle tombol layanan di footer
        const serviceLinks = document.querySelectorAll('.footer-column:nth-child(3) ul li a');
        serviceLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');

                if (href && href.startsWith('#')) {
                    // Ini adalah modal link
                    const target = this.getAttribute('data-bs-target') || href;
                    const modalElement = document.querySelector(target);

                    if (modalElement) {
                        // Pastikan modal lain ditutup dulu
                        const openModals = document.querySelectorAll('.modal.show');
                        openModals.forEach(openModal => {
                            const instance = bootstrap.Modal.getInstance(openModal);
                            if (instance) instance.hide();
                        });

                        // Tunggu sebentar sebelum membuka modal baru
                        setTimeout(() => {
                            const modal = new bootstrap.Modal(modalElement);
                            modal.show();
                        }, 50);
                    }
                }
            });
        });

        // Fungsi helper untuk membuka modal
        window.openModal = function(modalId) {
            const modalElement = document.getElementById(modalId);
            if (modalElement) {
                // Tutup modal lain yang terbuka
                const openModals = document.querySelectorAll('.modal.show');
                openModals.forEach(modal => {
                    const instance = bootstrap.Modal.getInstance(modal);
                    if (instance) instance.hide();
                });

                setTimeout(() => {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }, 50);
            }
        };

        // Fungsi untuk menutup semua modal
        window.closeAllModals = function() {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                const instance = bootstrap.Modal.getInstance(modal);
                if (instance) instance.hide();
            });

            // Hapus backdrop
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            // Reset body
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '';
        };

        // ESC key untuk close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.closeAllModals();
            }
        });

        // ================= RESPONSIVE HANDLING =================
        // Handle dropdown pada mobile
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    const dropdownMenu = this.nextElementSibling;
                    if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu-premium')) {
                        dropdownMenu.classList.toggle('show');
                    }
                }
            });
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                if (!e.target.closest('.dropdown')) {
                    const openDropdowns = document.querySelectorAll('.dropdown-menu-premium.show');
                    openDropdowns.forEach(dropdown => {
                        dropdown.classList.remove('show');
                    });
                }
            }
        });
    });

    // Handle window resize with debounce
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Adjust any responsive elements if needed
            const navLinks = document.querySelectorAll('.text-ellipsis');
            const screenWidth = window.innerWidth;

            if (screenWidth < 992) {
                navLinks.forEach(link => {
                    link.style.maxWidth = 'none';
                });

                // Tutup semua dropdown di mobile saat resize
                const openDropdowns = document.querySelectorAll('.dropdown-menu-premium.show');
                openDropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            } else {
                // Reset max-width untuk desktop
                navLinks.forEach(link => {
                    link.style.maxWidth = '';
                });
            }

            // Handle navbar collapse pada resize
            const navbarCollapse = document.getElementById('navbarContent');
            if (navbarCollapse && navbarCollapse.classList.contains('show') && screenWidth >= 992) {
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        }, 250);
    });

    // Prevent navbar toggle dari bubbling
    document.addEventListener('DOMContentLoaded', function() {
        const navbarToggler = document.querySelector('.navbar-toggler');
        if (navbarToggler) {
            navbarToggler.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });

    // Alert auto-hide
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
</body>
</html>
