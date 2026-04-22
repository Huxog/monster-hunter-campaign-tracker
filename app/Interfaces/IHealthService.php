<?php

namespace App\Interfaces;

interface IHealthService
{
    public function check(): array;
}
