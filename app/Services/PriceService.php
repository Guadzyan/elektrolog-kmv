<?php

namespace App\Services;

class PriceService
{
    public function getPrice(): array
    {
        return config('price');
    }
}
