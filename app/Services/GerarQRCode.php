<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class GerarQRCode
{
    public function gerar(float $valor_pagar, int $numero) {

        $dadosPix = DadosPix::dados($valor_pagar, $numero);
        $payloadPix = (new GerarPayload())->gerarPixPayload($dadosPix);
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'scale' => 5,
        ]);
        $qrcode = (new QRCode($options))->render($payloadPix);

        return $qrcode;
    }    
}