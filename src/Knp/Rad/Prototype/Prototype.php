<?php

namespace Knp\Rad\Prototype;

use Knp\Rad\Prototype\Prototype\Method;

interface Prototype
{
    /**
     * {@inheritdoc}
     */
    public function __set($method, Method $prototype);

    /**
     * {@inheritdoc}
     */
    public function __call($method, array $arguments);
}
