<?php

namespace App\Enums;

enum GoalType : string {
    case weekly = 'weekly';
    case Monthly = 'monthly';
    case Yearly = ' yearly';
}