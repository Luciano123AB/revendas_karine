<?php

namespace App\Services;

class GerarPayload
{
    public function gerarPixPayload(array $dados): string {

        $payload = '';

        $payload .= $this->pixField('00', '01');
        $payload .= $this->pixField('01', '11');

        $merchant_info  = $this->pixField('00', 'BR.GOV.BCB.PIX');

        $merchant_info .= $this->pixField('01', $dados['chave_pix']);
        $payload .= $this->pixField('26', $merchant_info);
        $payload .= $this->pixField('52', '0000');
        $payload .= $this->pixField('53', '986');

        if (!empty($dados['valor'])) {
            $payload .= $this->pixField('54', number_format($dados['valor'], 2, '.', ''));
        }

        $payload .= $this->pixField('58', 'BR');
        $payload .= $this->pixField('59', substr($dados['nome'], 0, 25));
        $payload .= $this->pixField('60', substr($dados['cidade'], 0, 15));
        $payload .= $this->pixField('62', $this->pixField('05', $dados['txid']));
        $payload .= '63'.'04'.$this->crc16($payload);

        return $payload;
    }

    private function pixField(string $id, string $value): string {

        $size = str_pad(strlen($value), 2, '0', STR_PAD_LEFT);

        return $id.$size.$value;
    }

    private function crc16(string $payload): string {

        $payload .= '6304';
        $polynomial = 0x1021;
        $result = 0xFFFF;

        for ($i = 0; $i < strlen($payload); $i++) {
            $result ^= (ord($payload[$i]) << 8);

            for ($bit = 0; $bit < 8; $bit++) {
                if ($result & 0x8000) {
                    $result = ($result << 1) ^ $polynomial;
                } else {
                    $result <<= 1;
                }

                $result &= 0xFFFF;
            }
        }

        return strtoupper(str_pad(dechex($result), 4, '0', STR_PAD_LEFT));
    }
}