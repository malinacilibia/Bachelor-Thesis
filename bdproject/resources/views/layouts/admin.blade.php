<!DOCTYPE html>
<html lang="ro">
<head>
    @stack('styles')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f8fa;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
            background-color: #2A3F54;
            color: white;
            padding-top: 20px;
        }

        .sidebar h3 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #1ABB9C;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .top-navbar {
            height: 60px;
            background-color: #EDEDED;
            margin-left: 250px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ccc;
        }

        .top-navbar .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-navbar .user-info img {
            border-radius: 50%;
            width: 35px;
            height: 35px;
        }

        .top-navbar .dropdown-toggle {
            cursor: pointer;
        }.hover-bg:hover {
             background-color: #1f1f2e;
             transition: 0.2s ease;
             border-left: 4px solid #0dcaf0;
         }

        .sidebar .nav-link {
            font-size: 15px;
            font-weight: 500;
            border-radius: 0;
        }
        .content {
            min-height: 100vh;
            background-color: #1e1e2f;
            padding-bottom: 80px;
        }


    </style>
</head>
<body>
<div class="sidebar bg-dark text-light position-fixed d-flex flex-column" id="sidebar" style="width: 250px; height: 100vh; border-right: 1px solid #333;">
    <div class="text-center py-4 border-bottom border-secondary">
        <h5 class="fw-bold mb-2">Admin Panel</h5>
        <img src="{{ asset('images/admin.jpg') }}" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
    </div>

    <ul class="nav flex-column mt-3">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pisici') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-file-earmark-text-fill"></i> Pisici
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.cat.breed.form') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-heart-fill"></i> Rase pisici
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.adoptie') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-check2-square"></i> Adopții
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.utilizatori.index') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-people-fill"></i> Utilizatori
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.appointments.index') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-calendar-check-fill"></i> Programări
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.reminders') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-calendar-check-fill"></i> Reminders
            </a>
        </li>
        <li><hr class="text-secondary my-2 mx-4"></li>

        <li class="nav-item">
            <a href="{{ route('admin.donations') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-cash-coin"></i> Donații
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.stories') }}" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-journal-richtext"></i> Povești
            </a>
        </li>



        <li class="nav-item mt-auto">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-light px-4 py-3 d-flex align-items-center gap-2 hover-bg">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </li>
    </ul>
</div>

<div class="top-navbar bg-dark px-4 py-2 d-flex justify-content-between align-items-center" style="margin-left: 250px; border-bottom: 1px solid #333;">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-dark border-0" id="toggleSidebar">
            <i class="bi bi-list fs-5 text-light"></i>
        </button>
    </div>

    <div class="d-flex align-items-center gap-3">


        <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/admin.jpg') }}" class="rounded-circle" width="35" height="35" style="object-fit: cover;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</div>


<div class="content bg-dark text-light">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        const content = document.querySelector('.content');
        const topbar = document.querySelector('.top-navbar');

        sidebar.classList.toggle('d-none');

        if (sidebar.classList.contains('d-none')) {
            content.style.marginLeft = '0';
            topbar.style.marginLeft = '0';
        } else {
            content.style.marginLeft = '250px';
            topbar.style.marginLeft = '250px';
        }
    });
</script>

@stack('scripts')

</body>
</html>
