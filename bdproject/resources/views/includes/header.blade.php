<nav class="navbar navbar-expand-lg shadow-sm p-0" style="background-color: #ADEBB3;border-bottom: 2px solid #5EB489; position:relative; height: auto;">
    <div class="d-flex align-items-center justify-content-between w-100" style="padding: 0; height: auto;">
        <div class="d-flex align-items-center gap-2 me-2">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/Whisker.png') }}" alt="WhiskerRescue" style="height: 100px; margin: 0; padding: 0; display: block;">
            </a>


            <button id="toggleMenuBtn" class="btn border-0 fw-semibold text-dark p-0" style="background: transparent; font-size: 0.95rem;">
                TOTUL DESPRE PISICI <span style="font-size: 1.1rem;">▾</span>
            </button>
        </div>
    </div>
    @auth
    <div class="nav-item">
        <a href="{{ route('wishlist') }}" class="nav-link position-relative" style="
        color: #5eb489;
        margin-right: 15px;
        padding: 10px 14px;
        font-size: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s, color 0.3s;
    ">
            <i class="bi bi-heart-fill" style="font-size: 28px;"></i>
        </a>
    </div>
    <div style="width: 1px; height: 80px; background-color: white; opacity: 0.4; margin-right:20px;"></div>
    @endauth
            <div class="d-flex align-items-center gap-3 ms-auto">
                @auth
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle position-relative" id="notifBell" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="
        background-color: #5EB489;
        color: white;
        border: none;
        border-radius: 999px;
        font-weight: 600;
        padding: 10px 24px;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    ">
                            <i class="bi bi-bell-fill"></i> Notificări
                            @if ($unreadCount > 0)
                                <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle" style="font-size: 0.75rem;">
                {{ $unreadCount }}
            </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end mt-2" id="notifDropdown" style="max-height: 300px; overflow-y: auto;">
                            @forelse ($notifications as $notification)
                                <a href="{{ $notification->data['url'] }}"
                                   class="dropdown-item notif-link d-flex align-items-center {{ $notification->read_at ? 'read' : 'unread' }}"
                                   data-id="{{ $notification->id }}">

                                    <i class="bi bi-shield-cat-fill me-2" style="font-size: 1.2rem; color: #5eb489;"></i>
                                    <span>{{ $notification->data['message'] }}</span>
                                </a>
                            @empty
                                <span class="dropdown-item text-muted">Nicio notificare nouă</span>
                            @endforelse

                        </div>
                    </div>

                @endauth


                    <div style="width: 1px; height: 80px; background-color: white; opacity: 0.4;"></div>

                    <ul class="navbar-nav d-flex flex-row gap-2 list-unstyled mb-0">
                    @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" style="
        background-color: #5EB489;
        color: white;
        border: none;
        border-radius: 999px;
        font-weight: 600;
        padding: 10px 24px;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    ">
                                    <i class="bi bi-person"></i> Login
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('register') }}" style="
        background-color: #5EB489;
        color: white;
        border: none;
        border-radius: 999px;
        font-weight: 600;
        padding: 10px 24px;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    ">
                                    <i class="bi bi-person-plus"></i> Register
                                </a>
                            </li>
                        @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="
        background-color: #5EB489;
        color: white;
        border: none;
        border-radius: 999px;
        font-weight: 600;
        padding: 10px 24px;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    ">
                                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                                <i class="bi bi-person-circle me-1"></i> Profilul meu
                                            </a>
                                            <a class="dropdown-item  fw-semibold" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            @endguest
                </ul>
            </div>

</nav>

<div class="shadow-sm py-2" id="extendedMenu" style="transform: scaleY(0); transform-origin: top; transition: transform 0.3s ease, opacity 0.3s ease; opacity: 0; background-color: #E8FAEA; width: 100%; position:absolute; top:100px; left:0; z-index:999;">
    <div class="container" style="width: 100%; padding: 0;">
        <ul class="navbar-nav flex-row flex-wrap gap-3 align-items-center" style="color:black; width: 100%; justify-content: space-evenly; text-align: center;">
            <li class="nav-item dropdown" style="flex: 1; position: relative;" onmouseover="showDropdown('dropdownAdopta')" onmouseout="hideDropdown('dropdownAdopta')">
                <a class="nav-link dropdown-toggle" style="font-size: 1rem; font-weight: 600; color: black; pointer-events: none;">
                    ADOPTĂ
                </a>
                <ul class="dropdown-menu" id="dropdownAdoptaMenu" aria-labelledby="dropdownAdopta" style="background-color: #e8faea; position: absolute; left: 0; top: 100%; width: 100%; text-align: left; display: none; position: absolute; border:none; z-index:1000; border-radius:0; ">
                    <li><a class="dropdown-item" href="/adoption" style="font-size: 0.8rem; color: black;font-weight: bold;border-top: 1px solid #cce5cc;border-bottom: 1px solid #cce5cc; padding: 12px 20px;">Adoptă acum!</a></li>
                    <li><a class="dropdown-item" href="/services" style="font-size: 0.8rem; color: black;font-weight: bold;border-bottom: 1px solid #cce5cc; padding: 12px 20px;">Despre noi</a></li>
                    @auth
                        <li><a class="dropdown-item" href="/home" style="font-size: 0.8rem; color: black;font-weight: bold;border-bottom: 1px solid #cce5cc; padding: 12px 20px;">Cererile tale</a></li>
                        <li><a class="dropdown-item" href="{{ route('appointments.index') }}" style="font-size: 0.8rem; color: black;font-weight: bold; padding: 12px 20px; ">Programările tale</a></li>
                    @endauth
                </ul>
            </li>

            <li class="nav-item dropdown" style="flex: 1; position: relative;" onmouseover="showDropdown('dropdownPisici')" onmouseout="hideDropdown('dropdownPisici')">
                <a class="nav-link dropdown-toggle" style="font-size: 1rem; font-weight: 600; color: black; pointer-events: none;">
                    PISICI
                </a>
                <ul class="dropdown-menu" id="dropdownPisiciMenu" aria-labelledby="dropdownPisici" style="background-color: #e8faea; position: absolute; left: 0; top: 100%; width: 100%; text-align: left; display: none; position: absolute; border:none; z-index:1000; border-radius:0; font-weight: bold;">
                    <li><a class="dropdown-item" href="/posts" style="font-size: 0.8rem; color: black;font-weight: bold; border-bottom: 1px solid #cce5cc; padding: 12px 20px;border-top: 1px solid #cce5cc;">Pisici disponibile</a></li>
                    <li><a class="dropdown-item" href="{{ route('adoption.stories') }}" style="font-size: 0.8rem; color: black;font-weight: bold; border-bottom: 1px solid #cce5cc; padding: 12px 20px;">Povești de adopție</a></li>
                    @auth
                        <li><a class="dropdown-item" href="{{ route('my.stories') }}" style="font-size: 0.8rem; color: black;font-weight: bold; padding: 12px 20px;">Poveștile mele</a></li>
                    @endauth
                </ul>
            </li>

            <li class="nav-item" style="flex: 1;">
                <a class="nav-link" href="{{ route('help.options') }}" style="font-size: 1rem; font-weight: 600; color: black;">DONEAZĂ</a>
            </li>
            <li class="nav-item" style="flex: 1;">
                <a class="nav-link" href="/services" style="font-size: 1rem; font-weight: 600; color: black;">PROCESUL</a>
            </li>
        </ul>
    </div>
</div>

<script>
    function showDropdown(dropdownId) {
        document.getElementById(dropdownId + 'Menu').style.display = 'block';
    }

    function hideDropdown(dropdownId) {
        document.getElementById(dropdownId + 'Menu').style.display = 'none';
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("toggleMenuBtn");
        const extendedMenu = document.getElementById("extendedMenu");

        toggleBtn.addEventListener("click", () => {
            const isVisible = extendedMenu.style.transform === "scaleY(1)";

            if (isVisible) {
                extendedMenu.style.transform = "scaleY(0)";
                extendedMenu.style.opacity = "0";
            } else {
                extendedMenu.style.transform = "scaleY(1)";
                extendedMenu.style.opacity = "1";
            }
        });


        const dropdownElements = document.querySelectorAll('#extendedMenu .dropdown-toggle');
        dropdownElements.forEach(el => {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                const currentDropdown = bootstrap.Dropdown.getOrCreateInstance(el);
                currentDropdown.toggle();

                dropdownElements.forEach(otherEl => {
                    if (otherEl !== el) {
                        const otherDropdown = bootstrap.Dropdown.getInstance(otherEl);
                        if (otherDropdown) {
                            otherDropdown.hide();
                        }
                    }
                });
            });
        });
    });

</script>

<style>
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        display: none;
        background-color: #adebb3;
        border: none;
        padding: 1rem 0;
        z-index: 1000;
        margin-top: 5px;
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        font-size: 0.9rem;
        padding: 8px 20px;
        color: black;
    }
</style>


