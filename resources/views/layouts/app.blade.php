<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'سامانه مدیریت پرسنل')
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        .app-footer {
            margin: 0 28px 28px;
            padding: 20px 24px;
            background: #ffffff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-logo {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, var(--gold), var(--gold-light));
            color: var(--navy-950);
            font-size: 13px;
            font-weight: 900;
            box-shadow: 0 7px 18px rgba(200, 164, 93, .18);
        }

        .footer-brand-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .footer-brand strong {
            color: var(--navy-800);
            font-size: 11px;
            font-weight: 900;
        }

        .footer-brand span {
            color: var(--gray-400);
            font-size: 8px;
        }

        .footer-contact {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 12px;
            background: var(--gold-soft);
            border: 1px solid rgba(200, 164, 93, .28);
            color: var(--navy-800);
            font-size: 12px;
            font-weight: 900;
        }

        .footer-contact-label {
            color: var(--gray-600);
            font-size: 11px;
            font-weight: 800;
        }

        .footer-contact a {
            color: var(--navy-800);
            font-size: 13px;
            font-weight: 950;
            transition: var(--transition);
        }

        .footer-contact a:hover {
            color: #a17f36;
        }

        .footer-copy {
            color: var(--gray-400);
            font-size: 9px;
        }

        @media (max-width: 700px) {
            .app-footer {
                margin: 0 14px 20px;
            }

            .footer-inner {
                flex-direction: column;
                text-align: center;
            }

            .footer-brand {
                flex-direction: column;
                gap: 7px;
            }
        }

        :root {

            --navy-950: #07111f;
            --navy-900: #0b1728;
            --navy-800: #102139;
            --navy-700: #17304d;

            --gold: #c8a45d;
            --gold-light: #e3c989;
            --gold-soft: #f8f1df;

            --white: #ffffff;

            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;

            --green: #15803d;
            --green-soft: #ecfdf3;

            --red: #dc2626;
            --red-soft: #fef2f2;

            --blue: #2563eb;
            --blue-soft: #eff6ff;

            --orange: #d97706;
            --orange-soft: #fff7ed;

            --sidebar-width: 270px;

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;

            --shadow-sm: 0 1px 3px rgba(15, 23, 42, .06);
            --shadow-md: 0 8px 30px rgba(15, 23, 42, .08);
            --shadow-lg: 0 20px 50px rgba(15, 23, 42, .12);

            --transition: .22s ease;
        }


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {

            font-family: 'Vazirmatn', sans-serif;

            background: var(--gray-100);

            color: var(--gray-900);

            min-height: 100vh;

            overflow-x: hidden;
        }


        a {
            color: inherit;
            text-decoration: none;
        }


        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }


        button {
            cursor: pointer;
        }


        ::selection {
            background: rgba(200, 164, 93, .25);
        }


        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }


        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }


        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 20px;
        }


        /* ================================
           APP
        ================================= */

        .app {
            min-height: 100vh;
        }


        /* ================================
           SIDEBAR
        ================================= */

        .sidebar {

            position: fixed;

            top: 0;
            right: 0;

            width: var(--sidebar-width);

            height: 100vh;

            z-index: 1000;

            display: flex;

            flex-direction: column;

            background:
                linear-gradient(
                    180deg,
                    var(--navy-950),
                    var(--navy-900)
                );

            color: white;

            box-shadow:
                -8px 0 30px rgba(7, 17, 31, .12);

            transition:
                transform var(--transition);
        }


        /* ================================
           BRAND
        ================================= */

        .sidebar-brand {

            height: 84px;

            padding: 0 20px;

            display: flex;

            align-items: center;

            gap: 12px;

            border-bottom:
                1px solid rgba(255, 255, 255, .07);
        }


        .brand-mark {

            width: 44px;
            height: 44px;

            flex-shrink: 0;

            border-radius: 13px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    145deg,
                    var(--gold),
                    var(--gold-light)
                );

            color: var(--navy-950);

            font-size: 17px;

            font-weight: 800;

            box-shadow:
                0 8px 22px rgba(200, 164, 93, .18);
        }


        .brand-text {
            min-width: 0;
        }


        .brand-title {

            color: white;

            font-size: 13px;

            font-weight: 800;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .brand-subtitle {

            margin-top: 4px;

            color: #7f91a8;

            font-size: 8px;

            white-space: nowrap;
        }


        /* ================================
           SIDEBAR BODY
        ================================= */

        .sidebar-body {

            flex: 1;

            overflow-y: auto;

            padding: 20px 14px;
        }


        .menu-group {
            margin-bottom: 25px;
        }


        .menu-label {

            padding: 0 11px;

            margin-bottom: 8px;

            color: #60758e;

            font-size: 8px;

            font-weight: 700;
        }


        .menu-item {
            margin-bottom: 3px;
        }


        .menu-link {

            min-height: 44px;

            padding: 0 12px;

            display: flex;

            align-items: center;

            gap: 11px;

            border-radius: 10px;

            color: #b9c5d3;

            font-size: 10px;

            font-weight: 500;

            transition: var(--transition);

            position: relative;
        }


        .menu-link:hover {

            color: white;

            background:
                rgba(255, 255, 255, .055);

            transform:
                translateX(-2px);
        }


        .menu-link.active {

            color: white;

            background:
                linear-gradient(
                    90deg,
                    rgba(200, 164, 93, .10),
                    rgba(200, 164, 93, .18)
                );
        }


        .menu-link.active::before {

            content: '';

            position: absolute;

            right: 0;

            top: 9px;
            bottom: 9px;

            width: 3px;

            border-radius: 5px;

            background: var(--gold);
        }


        .menu-icon {

            width: 23px;
            height: 23px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 7px;

            font-size: 13px;

            flex-shrink: 0;
        }


        .menu-link.active .menu-icon {

            background:
                rgba(200, 164, 93, .13);

            color:
                var(--gold-light);
        }


        .menu-name {
            flex: 1;
        }


        .menu-status {

            font-size: 7px;

            color: #687d94;
        }


        /* ================================
           SIDEBAR FOOTER
        ================================= */

        .sidebar-footer {

            padding: 14px;

            border-top:
                1px solid rgba(255, 255, 255, .07);
        }


        .user-box {

            padding: 10px;

            border-radius: 12px;

            display: flex;

            align-items: center;

            gap: 10px;

            background:
                rgba(255, 255, 255, .045);
        }


        .user-avatar {

            width: 38px;
            height: 38px;

            border-radius: 10px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                rgba(200, 164, 93, .14);

            color:
                var(--gold-light);

            font-weight: 800;

            flex-shrink: 0;
        }


        .user-info {
            min-width: 0;
        }


        .user-name {

            color: white;

            font-size: 9px;

            font-weight: 700;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .user-role {

            margin-top: 3px;

            color: #6d8198;

            font-size: 7px;
        }


        .sidebar-logout {
            width: 32px;
            height: 32px;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .04);
            color: #9eacbb;
            font-size: 15px;
            transition: var(--transition);
        }

        .sidebar-logout:hover {
            background: rgba(220, 38, 38, .14);
            border-color: rgba(248, 113, 113, .2);
            color: #fca5a5;
        }


        /* ================================
           MAIN
        ================================= */

        .main {

            min-height: 100vh;

            margin-right:
                var(--sidebar-width);

            transition:
                margin var(--transition);
        }


        /* ================================
           TOPBAR
        ================================= */

        .topbar {

            height: 76px;

            position: sticky;

            top: 0;

            z-index: 900;

            padding: 0 28px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            background:
                rgba(255, 255, 255, .94);

            backdrop-filter:
                blur(14px);

            border-bottom:
                1px solid var(--gray-200);
        }


        .topbar-left {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .topbar-title {

            display: flex;

            flex-direction: column;

            gap: 3px;
        }


        .topbar-title strong {

            font-size: 14px;

            font-weight: 800;
        }


        .topbar-title span {

            color:
                var(--gray-500);

            font-size: 8px;
        }


        .topbar-actions {

            display: flex;

            align-items: center;

            gap: 7px;
        }


        .topbar-btn {

            width: 38px;
            height: 38px;

            border:
                1px solid var(--gray-200);

            border-radius: 10px;

            background: white;

            display: flex;

            align-items: center;
            justify-content: center;

            color: var(--gray-500);

            transition:
                var(--transition);

            position: relative;
        }


        .topbar-btn:hover {

            color:
                var(--navy-800);

            border-color:
                var(--gray-300);

            background:
                var(--gray-50);
        }


        .notification-dot {

            position: absolute;

            top: 7px;
            right: 7px;

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background:
                var(--red);

            border:
                2px solid white;
        }


        .mobile-toggle {

            display: none;

            width: 38px;
            height: 38px;

            border:
                1px solid var(--gray-200);

            border-radius: 10px;

            background: white;
        }


        /* ================================
           PAGE
        ================================= */

        .page {

            padding:
                26px 28px 40px;
        }


        .breadcrumb {

            display: flex;

            align-items: center;

            gap: 7px;

            margin-bottom: 12px;

            color:
                var(--gray-400);

            font-size: 8px;
        }


        .breadcrumb .current {

            color:
                var(--gray-600);

            font-weight: 600;
        }


        .page-header {

            display: flex;

            align-items: flex-end;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 24px;
        }


        .page-header h1 {

            font-size: 22px;

            font-weight: 800;

            letter-spacing: -.3px;
        }


        .page-header p {

            margin-top: 5px;

            color:
                var(--gray-500);

            font-size: 9px;
        }


        .page-actions {

            display: flex;

            align-items: center;

            gap: 8px;
        }


        /* ================================
           CARD
        ================================= */

        .card {

            background: white;

            border:
                1px solid var(--gray-200);

            border-radius:
                var(--radius-lg);

            box-shadow:
                var(--shadow-sm);

            overflow: hidden;
        }


        .card-header {

            min-height: 68px;

            padding:
                16px 20px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            border-bottom:
                1px solid var(--gray-200);
        }


        .card-heading h2 {

            font-size: 12px;

            font-weight: 800;
        }


        .card-heading p {

            margin-top: 4px;

            color:
                var(--gray-500);

            font-size: 8px;
        }


        .card-body {
            padding: 20px;
        }


        /* ================================
           STATS
        ================================= */

        .stats {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 14px;

            margin-bottom: 20px;
        }


        .stat {

            padding: 18px;

            background: white;

            border:
                1px solid var(--gray-200);

            border-radius:
                var(--radius-lg);

            box-shadow:
                var(--shadow-sm);

            position: relative;

            overflow: hidden;

            transition:
                var(--transition);
        }


        .stat:hover {

            transform:
                translateY(-2px);

            box-shadow:
                var(--shadow-md);
        }


        .stat::after {

            content: '';

            position: absolute;

            left: -25px;

            bottom: -35px;

            width: 90px;
            height: 90px;

            border-radius: 50%;

            background:
                rgba(200, 164, 93, .07);
        }


        .stat-top {

            display: flex;

            align-items: center;

            justify-content: space-between;
        }


        .stat-icon {

            width: 40px;
            height: 40px;

            border-radius: 11px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 15px;
        }


        .stat-icon.gold {

            color: #94752f;

            background:
                var(--gold-soft);
        }


        .stat-icon.green {

            color:
                var(--green);

            background:
                var(--green-soft);
        }


        .stat-icon.blue {

            color:
                var(--blue);

            background:
                var(--blue-soft);
        }


        .stat-label {

            margin-top: 15px;

            color:
                var(--gray-500);

            font-size: 8px;
        }


        .stat-value {

            margin-top: 4px;

            font-size: 22px;

            font-weight: 800;
        }


        /* ================================
           BUTTONS
        ================================= */

        .btn {

            min-height: 39px;

            padding:
                0 14px;

            border:
                1px solid transparent;

            border-radius:
                9px;

            display:
                inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            font-size: 9px;

            font-weight: 600;

            transition:
                var(--transition);
        }


        .btn-primary {

            background:
                var(--navy-900);

            color: white;

            box-shadow:
                0 5px 14px rgba(7, 17, 31, .14);
        }


        .btn-primary:hover {

            background:
                var(--navy-800);

            transform:
                translateY(-1px);
        }


        .btn-gold {

            background:
                var(--gold);

            color:
                var(--navy-950);
        }


        .btn-gold:hover {

            background:
                var(--gold-light);

            transform:
                translateY(-1px);
        }


        .btn-secondary {

            background: white;

            color:
                var(--gray-700);

            border-color:
                var(--gray-200);
        }


        .btn-secondary:hover {

            background:
                var(--gray-50);

            border-color:
                var(--gray-300);
        }


        .btn-danger {

            background:
                var(--red-soft);

            color:
                var(--red);

            border-color:
                #fecaca;
        }


        .btn-sm {

            min-height: 30px;

            padding:
                0 9px;

            font-size: 8px;
        }


        /* ================================
           TOOLBAR
        ================================= */

        .toolbar {

            padding:
                14px 16px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

            background:
                var(--gray-50);

            border-bottom:
                1px solid var(--gray-200);
        }


        .search-box {

            flex: 1;

            max-width: 430px;
        }


        .search-box input {

            width: 100%;

            height: 39px;

            padding:
                0 13px;

            border:
                1px solid var(--gray-200);

            border-radius:
                9px;

            background: white;

            outline: none;

            font-size: 9px;

            transition:
                var(--transition);
        }


        .search-box input:focus {

            border-color:
                var(--gold);

            box-shadow:
                0 0 0 3px rgba(200, 164, 93, .10);
        }


        .toolbar-actions {

            display: flex;

            align-items: center;

            gap: 7px;
        }


        /* ================================
           TABLE
        ================================= */

        .table-wrapper {

            width: 100%;

            overflow-x: auto;
        }


        .data-table {

            width: 100%;

            border-collapse:
                collapse;

            font-size: 9px;
        }


        .data-table th {

            padding:
                13px 16px;

            background:
                var(--gray-50);

            color:
                var(--gray-500);

            font-size: 8px;

            font-weight: 700;

            text-align: right;

            white-space: nowrap;

            border-bottom:
                1px solid var(--gray-200);
        }


        .data-table td {

            padding:
                13px 16px;

            color:
                var(--gray-700);

            border-bottom:
                1px solid var(--gray-100);

            white-space: nowrap;
        }


        .data-table tbody tr {

            transition:
                var(--transition);
        }


        .data-table tbody tr:hover {

            background:
                #fcfcfd;
        }


        .employee-cell {

            display: flex;

            align-items: center;

            gap: 9px;
        }


        .employee-avatar {

            width: 36px;
            height: 36px;

            border-radius: 10px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                var(--navy-900);

            color:
                var(--gold-light);

            font-size: 11px;

            font-weight: 800;

            flex-shrink: 0;
        }


        .employee-name {

            color:
                var(--gray-900);

            font-weight: 700;

            font-size: 9px;
        }


        .employee-phone {

            margin-top: 3px;

            color:
                var(--gray-400);

            font-size: 7px;
        }


        /* ================================
           BADGES
        ================================= */

        .badge {

            display: inline-flex;

            align-items: center;

            gap: 4px;

            padding:
                5px 8px;

            border-radius:
                20px;

            font-size: 7px;

            font-weight: 700;
        }


        .badge-gold {

            color:
                #806426;

            background:
                var(--gold-soft);
        }


        .badge-blue {

            color:
                var(--blue);

            background:
                var(--blue-soft);
        }


        .badge-success {

            color:
                var(--green);

            background:
                var(--green-soft);
        }


        /* ================================
           EMPTY
        ================================= */

        .empty-state {

            padding:
                60px 20px;

            text-align:
                center;
        }


        .empty-icon {

            width: 60px;
            height: 60px;

            margin:
                0 auto 14px;

            border-radius:
                16px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                var(--gold-soft);

            color:
                #806426;

            font-size: 24px;
        }


        .empty-title {

            font-size: 12px;

            font-weight: 800;
        }


        .empty-description {

            margin-top: 6px;

            color:
                var(--gray-500);

            font-size: 8px;
        }


        /* ================================
           ALERT
        ================================= */

        .alert {

            margin-bottom: 18px;

            padding:
                12px 14px;

            border-radius:
                10px;

            display: flex;

            gap: 9px;

            align-items: center;

            font-size: 9px;
        }


        .alert-success {

            color: #166534;

            background:
                var(--green-soft);

            border:
                1px solid #bbf7d0;
        }


        .alert-danger {

            color: #991b1b;

            background:
                var(--red-soft);

            border:
                1px solid #fecaca;
        }

        .sidebar-overlay {

    position: fixed;

    inset: 0;

    z-index: 999;

    background: rgba(7, 17, 31, .45);

    backdrop-filter: blur(2px);

    opacity: 0;

    visibility: hidden;

    pointer-events: none;

    transition:
        opacity var(--transition),
        visibility var(--transition);
}





.sidebar-overlay.show {

    opacity: 1;

    visibility: visible;

    pointer-events: auto;
}


        /* ================================
           RESPONSIVE
        ================================= */

        @media (max-width: 1000px) {

            .stats {

                grid-template-columns:
                    repeat(2, 1fr);
            }
        }


        @media (max-width: 850px) {

            .sidebar {

                transform:
                    translateX(100%);
            }


            .sidebar.open {

                transform:
                    translateX(0);
            }


            .main {

                margin-right: 0;
            }


            .mobile-toggle {

                display: flex;

                align-items: center;

                justify-content: center;
            }
        }


        @media (max-width: 600px) {

            .page {

                padding:
                    18px 14px 30px;
            }


            .topbar {

                padding:
                    0 14px;
            }


            .page-header {

                align-items:
                    flex-start;

                flex-direction:
                    column;
            }


            .page-actions {

                width: 100%;
            }


            .page-actions .btn {

                flex: 1;
            }


            .stats {

                grid-template-columns:
                    1fr;
            }


            .toolbar {

                align-items:
                    stretch;

                flex-direction:
                    column;
            }


            .search-box {

                max-width:
                    none;
            }


            .toolbar-actions {

                width: 100%;
            }


            .toolbar-actions .btn {

                flex: 1;
            }
        }

        .section-title-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: var(--gold-100, #f5ead0);
    font-size: 20px;
    flex-shrink: 0;
}

    </style>

    @stack('styles')

</head>


<body>

<div class="app">


    {{-- SIDEBAR --}}

    <aside class="sidebar" id="sidebar">

       <a
    href="{{ Route::has('dashboard') ? route('dashboard') : route('employees.index') }}"
    class="sidebar-brand"
    style="cursor:pointer;"
>

    <div class="brand-mark">
        P
    </div>

    <div class="brand-text">

        <div class="brand-title">
            سامانه مدیریت پرسنل
        </div>

        <div class="brand-subtitle">
            Personal Management System
        </div>

    </div>

</a>


        <div class="sidebar-body">


            {{-- اصلی --}}

            <div class="menu-group">

                <div class="menu-label">
                    اصلی
                </div>


                @if(Route::has('dashboard'))

                    <div class="menu-item">

                        <a
                            href="{{ route('dashboard') }}"
                            class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        >

                            <span class="menu-icon">
                                ⌂
                            </span>

                            <span class="menu-name">
                                داشبورد
                            </span>

                        </a>

                    </div>

                @endif

            </div>


            {{-- منابع انسانی --}}

            <div class="menu-group">

                <div class="menu-label">
                    مدیریت منابع انسانی
                </div>


                @if(Route::has('employees.index'))

                    <div class="menu-item">

                        <a
                            href="{{ route('employees.index') }}"
                            class="menu-link {{ request()->routeIs('employees.*') ? 'active' : '' }}"
                        >

                            <span class="menu-icon">
                                👥
                            </span>

                            <span class="menu-name">
                                پرسنل
                            </span>

                        </a>

                    </div>

                @endif


                @if(Route::has('departments.index'))

                    <div class="menu-item">

                        <a
                            href="{{ route('departments.index') }}"
                            class="menu-link {{ request()->routeIs('departments.*') ? 'active' : '' }}"
                        >

                            <span class="menu-icon">
                                ▦
                            </span>

                            <span class="menu-name">
                                واحدهای سازمانی
                            </span>

                        </a>

                    </div>

                @endif

            </div>


            {{-- امکانات آینده --}}

            <div class="menu-group">

                <div class="menu-label">
                    امکانات سیستم
                </div>


                @if(Route::has('leave-requests.index'))

    <div class="menu-item">

        <a
            href="{{ route('leave-requests.index') }}"
            class="menu-link {{ request()->routeIs('leave-requests.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ◷
            </span>

            <span class="menu-name">
                مدیریت مرخصی‌ها
            </span>

        </a>

    </div>

@endif

                <div class="menu-item">

                    <a href="#" class="menu-link">

                        <span class="menu-icon">
                            ◈
                        </span>

                        <span class="menu-name">
                            مساعده
                        </span>

                        <span class="menu-status">
                            به‌زودی
                        </span>

                    </a>

                </div>


                <div class="menu-item">

                    <a href="#" class="menu-link">

                        <span class="menu-icon">
                            ◫
                        </span>

                        <span class="menu-name">
                            گزارش‌ها
                        </span>

                        <span class="menu-status">
                            به‌زودی
                        </span>

                    </a>

                </div>

            </div>

        </div>


        {{-- USER --}}
        <div class="sidebar-footer">

            @auth
                <div class="user-box">

                    <div class="user-avatar">
                        {{ mb_substr(auth()->user()->name ?? 'م', 0, 1) }}
                    </div>

                    <div class="user-info">
                        <div class="user-name">
                            {{ auth()->user()->name ?? 'مدیر سیستم' }}
                        </div>

                        <div class="user-role">
                            مدیر سامانه
                        </div>
                    </div>

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        style="margin-right:auto;"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="sidebar-logout"
                            title="خروج از حساب"
                            aria-label="خروج از حساب"
                        >
                            ↪
                        </button>
                    </form>

                </div>
            @endif

        </div>

    </aside>


    {{-- MOBILE OVERLAY --}}

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


    {{-- MAIN --}}

    <main class="main">


        {{-- TOPBAR --}}

        <header class="topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    class="mobile-toggle"
                    id="mobileToggle"
                >
                    ☰
                </button>


                <div class="topbar-title">

                    <strong>
                        @yield('title', 'سامانه مدیریت پرسنل')
                    </strong>

                    <span>
                        سامانه مدیریت اطلاعات و فرآیندهای پرسنلی
                    </span>

                </div>

            </div>


            <div class="topbar-actions">

                <button
                    type="button"
                    class="topbar-btn"
                    title="اعلان‌ها"
                >

                    🔔

                    <span class="notification-dot"></span>

                </button>


                <button
                    type="button"
                    class="topbar-btn"
                    title="تنظیمات"
                >
                    ⚙
                </button>

            </div>

        </header>


        {{-- PAGE --}}

        <div class="page">


            @if(session('success'))

                <div class="alert alert-success">

                    <span>
                        ✓
                    </span>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if(session('error'))

                <div class="alert alert-danger">

                    <span>
                        !
                    </span>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            @yield('content')


        </div>

        {{-- APP FOOTER --}}
        <footer class="app-footer">

            <div class="footer-inner">

                <div class="footer-brand">

                    <div class="footer-logo">
                        PF
                    </div>

                    <div class="footer-brand-text">
                        <strong>Personal System Faraja</strong>
                        <span>سامانه مدیریت اطلاعات و فرآیندهای پرسنلی</span>
                    </div>

                </div>

                <div class="footer-contact">
                    <span class="footer-contact-label">
                        ارتباط با ما:
                    </span>

                    <a
                        href="https://t.me/amirreza2178"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        @amirreza2178
                    </a>
                </div>

                <div class="footer-copy">
                    © {{ now()->year }} تمامی حقوق محفوظ است.
                </div>

            </div>

        </footer>

    </main>

</div>


<script>

    const sidebar =
        document.getElementById('sidebar');

    const mobileToggle =
        document.getElementById('mobileToggle');

    const sidebarOverlay =
        document.getElementById('sidebarOverlay');


    function openSidebar() {

        if (sidebar) {
            sidebar.classList.add('open');
        }

        if (sidebarOverlay) {
            sidebarOverlay.classList.add('show');
        }
    }


    function closeSidebar() {

        if (sidebar) {
            sidebar.classList.remove('open');
        }

        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('show');
        }
    }


    if (mobileToggle) {

        mobileToggle.addEventListener(
            'click',
            openSidebar
        );

    }


    if (sidebarOverlay) {

        sidebarOverlay.addEventListener(
            'click',
            closeSidebar
        );

    }


    window.addEventListener(
        'resize',
        function () {

            if (window.innerWidth > 850) {

                closeSidebar();

            }

        }
    );

</script>


@stack('scripts')

</body>

</html>
