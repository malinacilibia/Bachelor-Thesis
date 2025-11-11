<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @if (!Request::is('adoption*'))
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>

    <script>
        window.userId = "{{ Auth::id() }}";
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "8000",
            "extendedTimeOut": "2000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher("b40ab8257e114d12c330", {
            cluster: "eu",
            encrypted: true,
            authEndpoint: "/broadcasting/auth",
            auth: {
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }
        });

        var userId = "{{ Auth::id() }}";

        if (userId) {
            var channel = pusher.subscribe("private-user." + userId);

            function showNotification(type, message, url = null) {
                var notification = toastr[type]("<strong>Notificare</strong><br>" + message);
                if (url) {
                    notification.css('cursor', 'pointer');
                    notification.click(() => window.location.href = url);
                }
            }

            channel.bind("App\\Events\\AdoptionStatusUpdated", data => {
                showNotification('success', data.message, data.url);
            });

            channel.bind("App\\Events\\AdoptionRequestRejected", data => {
                showNotification('warning', data.message, data.url);
            });

            channel.bind("App\\Events\\AppointmentStatusUpdated", data => {
                showNotification('success', data.message, data.url);
            });

            channel.bind("story.approved", data => {
                showNotification('success', data.message, data.url);
            });

            channel.bind("story.rejected", data => {
                showNotification('warning', data.message, data.url);
            });

            channel.bind("App\\Events\\AppointmentRejected", data => {
                showNotification('warning', data.message, data.url);
            });

            channel.bind("App\\Events\\AppointmentReminderSent", data => {
                showNotification('info', data.message, data.url);
            });

            channel.bind("App\\Events\\AppointmentFeedbackReceived", data => {
                showNotification('info', data.message, data.url);
            });

            channel.bind("App\\Events\\ReminderNotificationEvent", data => {
                showNotification('info', data.message, data.url);
            });

        } else {
            console.warn("User ID nu este definit, notificările nu vor funcționa.");
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".notif-link").forEach(item => {
                item.addEventListener("click", function (e) {
                    const notifId = this.getAttribute("data-id");

                    fetch(`/notifications/${notifId}/read`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }).then(response => {
                        if (response.ok) {
                            const badge = document.getElementById("notifDropdown").querySelector(".badge");
                            if (badge) {
                                let count = parseInt(badge.innerText) - 1;
                                if (count <= 0) {
                                    badge.remove();
                                } else {
                                    badge.innerText = count;
                                }
                            }
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const bell = document.getElementById("notifBell");
            const dropdown = document.getElementById("notifDropdown");

            bell.addEventListener("click", function (e) {
                e.preventDefault();
                dropdown.classList.toggle("show");
            });

            document.addEventListener("click", function (event) {
                if (!bell.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.remove("show");
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownToggle = document.getElementById("navbarDropdown");
            if (dropdownToggle) {
                dropdownToggle.addEventListener("click", function(event) {
                    event.preventDefault();
                    var dropdownMenu = this.nextElementSibling;
                    dropdownMenu.classList.toggle("show");
                });
            }
        });
    </script>


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">



    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .notif-link i {
            flex-shrink: 0;
            color: #5eb489;
        }

        #notifDropdown {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: block;
            float: left;
            min-width: 320px;
            max-width: 500px;
            padding: 8px 12px;
            margin: 0;
            font-size: 15px;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #e8faea;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        #notifDropdown {
            display: none;
        }

        #notifDropdown.show {
            display: block;
        }

        #notifDropdown .notif-link {
            width: 100%;
            display: block;
            padding: 12px 16px;
            margin: 0 0 6px 0;
            white-space: normal;
            word-wrap: break-word;
            font-size: 15px;
            line-height: 1.5;
            background-color: #e8faea;
            color: #0c0000;
            border-radius: 8px;
            border: none;
            box-shadow: none;
            transition: background-color 0.3s ease;
        }

        #notifDropdown .notif-link:last-child {
            margin-bottom: 0;
        }

        #notifDropdown .notif-link.unread {
            font-weight: bold;
        }

        #notifDropdown .notif-link.read {
            background-color: #e8f5f1;
            color: #333;
        }

        #notifDropdown .notif-link:hover {
            background-color: #4da77a;
            transform: scale(1.01);
            cursor: pointer;
        }



        #toast-container > .toast {
             display: flex;
             align-items: center;
             justify-content: flex-start;
             gap: 12px;
             position: relative;
             border-radius: 16px;
             padding: 18px 26px;
             font-family: 'Nunito', sans-serif;
             font-size: 16px;
             line-height: 1.6;
             box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
         }

        #toast-container > .toast-success {
            background-color: #ffe3ec;
            color: #5eb489;
        }

        #toast-container > .toast-info {
            background-color: #e0f7fa;
            color: #007b8a;
        }

        #toast-container > .toast-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        #toast-container > .toast-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        #toast-container > .toast::before {
            margin-right: 10px;
            font-size: 16px;
            margin-top: 2px;
            width: 20px;
            display: inline-block;
            flex-shrink: 0;
            vertical-align: middle;
            text-align: center;
        }
        #toast-container > .toast .toast-close-button {
            position: absolute;
            top: 10px;
            right: 14px;
            color: #91314f;
            font-size: 20px;
        }
        #toast-container .toast-title {
            font-weight: bold;
            margin-right: 10px;
            font-size: 18px;
        }
        body {
            background-color: #f6f5e9;
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
<div id="app">
    @include('includes.header')

    <div class="w-100 p-0 m-0">
        @include('inc.messages')
        <main class="p-0 m-0">
            @yield('content')
        </main>
    </div>

</div>

@include('includes.footer')
@yield('scripts')

</body>
</html>
