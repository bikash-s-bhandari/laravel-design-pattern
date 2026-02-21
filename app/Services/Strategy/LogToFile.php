<?php

namespace App\Services\Strategy;

use App\Contracts\LoggerInterface;

class LogToFile implements LoggerInterface
{
    public function log(string $message)
    {
        info('Logging to file: '.$message);
    }
}
