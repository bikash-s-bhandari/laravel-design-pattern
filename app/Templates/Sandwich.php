<?php

namespace App\Templates;

abstract class Sandwich
{
    // Template method
    public function make()
    {
        $this->getBread();
        $this->addMainIngredient();
        $this->addCondiments();
        $this->cut();
        $this->serve();
    }

    protected function getBread()
    {
        echo "Getting bread\n";
    }

    abstract protected function addMainIngredient();
    abstract protected function addCondiments();

    protected function cut()
    {
        echo "Cutting the sandwich\n";
    }

    protected function serve()
    {
        echo "Serving the sandwich\n";
    }
}
