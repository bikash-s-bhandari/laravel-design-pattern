<?php

namespace App\Chain;

abstract class BaseOrderHandler implements OrderHandler
{
    private ?OrderHandler $next = null;

    public function setNext(OrderHandler $handler): OrderHandler
    {
        $this->next = $handler;
        return $handler;
    }

    protected function passToNext(array $order): array
    {
        if ($this->next) {
            return $this->next->handle($order);
        }

        // Chain end reached - all checks passed!
        return [
            'success' => true,
            'message' => 'All checks passed!',
        ];
    }
}
