<?php

namespace Knp\Rad\Prototype\Prototype;

trait Controller
{
    /**
     * @param string $scope
     *
     * @return
     */
    public function canReach($scope)
    {
        return true;
    }

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
        if (false === isset($this->$method)) {
            throw new \BadMethodCallException();
        }

        if (false === $this->$method instanceof Method) {
            throw new \BadMethodCallException();
        }

        return call_user_func_array($this->$method, $arguments);
    }
}
