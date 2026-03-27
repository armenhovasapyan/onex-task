<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PENDING = 0;

    case Success = 1;

    case Declined = -1;
}
