<?php

namespace App\Services;

class DadosPix
{
    public static function dados(float $valor_pagar, int $numero) {

        $dados_pix = [
            'chave_pix' => '12109801930',
            'nome' => strtoupper(substr(config('app.name'), 0, 25)),
            'cidade' => 'RIO GRANDE DO SUL',
            'valor' => $valor_pagar,
            'txid' => 'PEDIDO' . $numero
        ];

        return $dados_pix;
    }
}