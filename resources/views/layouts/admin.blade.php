<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Tahoma, Arial;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
        }

        .sidebar a {
            text-decoration: none;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand">UnifiedExamManagement</span>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">تسجيل الخروج</button>
            </form>
        </div>
    </nav>

    <div class="d-flex">

        <!-- Sidebar -->
        <aside class="sidebar bg-white shadow-sm p-3">
            <h6 class="text-muted mb-3">القائمة الرئيسية</h6>

            <ul class="nav nav-pills flex-column gap-1">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        لوحة التحكم
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.*') ? 'active' : '' }}"
                        href="{{ route('student.index') }}">
                        الطلاب
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('professor.*') ? 'active' : '' }}"
                        href="{{ route('professor.index') }}">
                        الدكاترة
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('year.*') ? 'active' : '' }}"
                        href="{{ route('year.index') }}">
                        سنوات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('Professoryear.*') ? 'active' : '' }}"
                        href="{{ route('Professoryear.index') }}">
                        تكليف المدرسين بالسنوات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('questions.*') ? 'active' : '' }}"
                        href="{{ route('questions.show_admin') }}">بنك الأسئلة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('examcycles.*') ? 'active' : '' }}"
                        href="{{ route('examcycles.index') }}">الدورات الامتحانية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('examcenters.*') ? 'active' : '' }}"
                        href="{{ route('examcenters.index') }}">المراكز الامتحانية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ExamSchedules.*') ? 'active' : '' }}"
                        href="{{ route('ExamSchedules.index') }}">البرنامج الامتحانية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('report_admin_show.*') ? 'active' : '' }}"
                        href="{{ route('report_admin_show') }}">النتائج</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="nav-link text-danger">تسجيل الخروج</a>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Content -->
        <main class="flex-fill p-4">
            @if (session('alert'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                     {{ session('alert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </main>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
