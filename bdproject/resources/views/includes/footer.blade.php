<footer class="text-center text-md-start py-4 px-3" style="background-color: #adebb3; color: #2e2e2e; box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.05); border-top: 2px solid #5EB489;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0 d-flex flex-column align-items-md-start align-items-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/Whisker.png') }}" alt="WhiskerRescue" style="height: 100px;">
                </a>
            </div>

            <div class="col-md-6 d-flex justify-content-md-end justify-content-center">
                <ul class="list-unstyled d-flex flex-column gap-2 text-center text-md-end">
                    <li>
                        <a href="https://wa.me/+40744118481?text=Am%20o%20intrebare%20legata%20de%20adopție."
                           target="_blank"
                           class="footer-link d-flex align-items-center justify-content-center justify-content-md-end gap-2">
                            <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" style="height: 50px; width:50px;">
                            Contactează-ne pe WhatsApp
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr style="border-color: #5EB489;">
        <div class="text-center" style=" font-weight:bold; font-size: 0.9rem;">&copy; 2025 {{ config('app.name', 'WhiskerRescue') }}. Toate drepturile rezervate.</div>
    </div>
</footer>


<style>
    .footer-link {
        color: #2e2e2e;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .footer-link:hover {
        color: #91314f;
        text-decoration: underline;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #app {
        flex: 1;
    }
</style>
