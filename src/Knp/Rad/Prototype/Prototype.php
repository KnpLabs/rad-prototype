<?php

namespace Knp\Rad\Prototype;

use Knp\Rad\Prototype\Prototype\Method;

interface Prototype
{
    /**
     * @param string $scope
     *
     * @return boolean
     */
    public function canReach($scope);

    /**
     * {@inheritdoc}
     */
    public function __set($method, Method $prototype);

    /**
     * {@inheritdoc}
     */
    public function __call($method, array $arguments);
}
