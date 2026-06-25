<?php

namespace App\Enums;

enum CompraStatus: string
{
    case PENDENTE = 'Pendente';
    case APROVADO = 'Aprovado';
    case CANCELADO = 'Cancelado';    
}