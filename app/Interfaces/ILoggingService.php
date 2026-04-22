<?php

namespace App\Interfaces;

interface ILoggingService
{
    public function info(string $domain, string $message, array $context = []): void;

    public function warning(string $domain, string $message, array $context = []): void;

    public function error(string $domain, string $message, array $context = []): void;
}
