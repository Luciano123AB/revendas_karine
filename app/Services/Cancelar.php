<?php

namespace App\Services;

use App\Enums\CompraStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Cancelar
{
    public static function cancelarCompra($compra, $produto) {
        try {
            DB::transaction(function () use ($compra, $produto) {
                $compra->status = CompraStatus::CANCELADO;
                $compra->data_efetuacao = Carbon::now();
                $compra->updated_at = Carbon::now();

                $produto->estoque += $compra->quantidade;

                $compra->saveOrFail();
                $produto->saveOrFail();
            });

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}