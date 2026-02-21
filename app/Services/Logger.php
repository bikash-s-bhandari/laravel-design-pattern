<?php

namespace App\Services;

use App\Contracts\LoggerInterface;

class Logger
{
    public function __construct(
        protected LoggerInterface $logger
    ) {}

    // Runtime मा logger बदल्न मिल्छ
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function doSomething(): void
    {
        // काम गर्छ...
        $this->logger->log("केही काम गरियो!");
    }
}
