<?php

namespace App\Chain;

interface OrderHandler
{
    public function setNext(OrderHandler $handler): OrderHandler;
    public function handle(array $order): array;
}
