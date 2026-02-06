@extends("layouts.main_layout")

@section("content")
    <div class="fundo card" id="qrcode">
        <h5 class="card-header text-center">QRCode</h5>
        <img src="{{ $qrcode }}" class="card-img-top">
        <div class="card-body">
            <p class="card-text">Após realizar o pagamento, envie o comprovante pelo nosso whatsapp que se encontra na barra inferior da página, informando seu nome de usuário.</p>
        </div>
        <div class="card-footer"></div>
    </div>
@endsection