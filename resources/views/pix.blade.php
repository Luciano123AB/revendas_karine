@extends("layouts.main_layout")

@section("content")
    <div class="card" id="qrcode">
        <h5 class="card-header text-center">QRCode</h5>
        <img src="{{ $qrcode }}">
        <div class="card-body">
            <p>Após realizar o pagamento, envie o comprovante pelo nosso whatsapp que se encontra na barra inferior da página.</p>
        </div>
    </div>
@endsection