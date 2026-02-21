<?php

namespace App\Services\Strategy;

use App\Contracts\LoggerInterface;

class LogToWebService implements LoggerInterface
{
    public function log(string $message)
    {
        info('Logging to web service: '.$message);
    }
}
