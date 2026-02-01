<footer class="bg-warning border-5 border-top border-black text-center mt-5 py-3">
    <div id="direitos" class="justify-content-center align-items-center gap-3">
        <div>
            <span>
                Todos os Direitos Reservados: Karine
                <br>
                © 2026 - {{ date("Y") }} {{ config("app.name") }}
            </span>
        </div>

        <div class="d-grid">
            <span class="mb-1">Siga-nos:</span>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" target="_blank" class="fundo btn border border-dark text-decoration-none text-dark focus-ring focus-ring-danger fs-4"><i class="bi bi-instagram"></i></a>
                <a href="#" target="_blank" class="fundo btn border border-dark text-decoration-none text-dark focus-ring focus-ring-danger fs-4"><i class="bi bi-facebook"></i></a>
                <a href="#" target="_blank" class="fundo btn border border-dark text-decoration-none text-dark focus-ring focus-ring-danger fs-4"><i class="bi bi-twitter-x"></i></a>
                <a href="#" target="_blank" class="fundo btn border border-dark text-decoration-none text-dark focus-ring focus-ring-danger fs-4"><i class="bi bi-tiktok"></i></a>
                <a href="#" target="_blank" class="fundo btn border border-dark text-decoration-none text-dark focus-ring focus-ring-danger fs-4"><i class="bi bi-threads"></i></a>
            </div>
            
            <div class="mt-1">
                <i class="bi bi-whatsapp"></i>
                <span>Whatsapp: +595 994 817751</span>
            </div>
        </div>

        <div>
            <span>
                Pagamentos:
                <br>
                <img src="{{ asset('assets/images/pix.png') }}" style="max-height: 50px;">
            </span>
        </div>
    </div>
</footer>