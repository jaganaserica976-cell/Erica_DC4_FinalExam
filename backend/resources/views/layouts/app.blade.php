<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Grades Management System')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<header class="topbar">
    <a class="brand" href="{{ route('dashboard') }}">
        <span class="brand-mark">SG</span>
        <span class="brand-name">Grade<span>book</span></span>
    </a>

    @auth
        <div class="topbar-user">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="user-details">
                <span class="user-name">{{ auth()->user()->name }}</span>
                <span class="user-role">{{ auth()->user()->role }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-logout" type="submit">Log out</button>
            </form>
        </div>
    @endauth
</header>

<div class="app-shell">
    @auth
        <aside class="sidebar">
            <span class="sidebar-label">MENU</span>
            <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               href="{{ route('dashboard') }}">
                <span class="nav-icon">⌂</span> Overview
            </a>

            @if(auth()->user()->role === 'Admin')
                <span class="sidebar-label sidebar-section">MANAGEMENT</span>
                <a class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}"
                   href="{{ route('students.index') }}"><span class="nav-icon">♙</span> Students</a>
                <a class="sidebar-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}"
                   href="{{ route('teachers.index') }}"><span class="nav-icon">♧</span> Teachers</a>
                <a class="sidebar-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}"
                   href="{{ route('subjects.index') }}"><span class="nav-icon">▤</span> Subjects</a>
                <a class="sidebar-link {{ request()->routeIs('classes.*') ? 'active' : '' }}"
                   href="{{ route('classes.index') }}"><span class="nav-icon">▦</span> Classes</a>
                <a class="sidebar-link {{ request()->routeIs('grades.*') ? 'active' : '' }}"
                   href="{{ route('grades.index') }}"><span class="nav-icon">▧</span> Grades</a>
            @elseif(auth()->user()->role === 'Teacher')
                <span class="sidebar-label sidebar-section">TEACHING</span>
                <a class="sidebar-link {{ request()->routeIs('teacher.grades.*') ? 'active' : '' }}"
                   href="{{ route('teacher.grades.index') }}"><span class="nav-icon">▧</span> Gradebook</a>
            @endif
        </aside>
    @endauth

    <main class="main-content">
        <div class="content-wrap">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>