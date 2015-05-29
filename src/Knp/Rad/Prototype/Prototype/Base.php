<?php

namespace Knp\Rad\Prototype\Prototype;

use Knp\Rad\Prototype\Prototype;
use Knp\Rad\Prototype\Prototype\Method;

class Base implements Prototype
{
    /**
     * {@inheritdoc}
     */
    public function __set($method, Method $prototype)
    {
        $this->$method = $prototype;
    }

    /**
     * {@inheritdoc}
     */
    public function __call($method, array $arguments)
    {
        return call_user_func_array($this->$method, $arguments);
    }
}
