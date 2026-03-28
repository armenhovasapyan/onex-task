<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = '0';

    case CONFIRMED = '1';

    case CANCELED = '-1';
}
