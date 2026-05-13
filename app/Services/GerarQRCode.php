<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class GerarQRCode
{
    public function gerar(float $valor_pagar, int $numero) {

        $dados_pix = DadosPix::dados($valor_pagar, $numero);
        $payload_pix = (new GerarPayload())->gerarPixPayload($dados_pix);
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'scale' => 5,
        ]);
        $qrcode = (new QRCode($options))->render($payload_pix);

        return $qrcode;
    }    
}