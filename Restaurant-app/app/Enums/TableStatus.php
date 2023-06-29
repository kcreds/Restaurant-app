<?php

namespace App\Enums;

enum TableStatus: string{
    
    case Pending = 'Pending';
    case Avaliable = 'Avaliable';
    case Unavaliable = 'Unavaliable';
}