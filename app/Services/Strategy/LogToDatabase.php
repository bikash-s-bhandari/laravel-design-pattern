<?php

namespace App\Services\Strategy;

use App\Contracts\LoggerInterface;

class LogToDatabase implements LoggerInterface
{
    public function log(string $message)
    {
        info('Logging to database: '.$message);
    }
}
