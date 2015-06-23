<?php

namespace Knp\Rad\Prototype\Prototype;

use Knp\Rad\Prototype\Prototype;

class Base implements Prototype
{
    use Controller;

    /**
     * @var string[]
     */
    private $scopes;

    public function __construct(array $scopes = [])
    {
        $this->scopes = $scopes;
    }

    /**
     * {@inheritdoc}
     */
    public function canReach($scope)
    {
        if (true === empty($this->scopes)) {
            return true;
        }

        return in_array($scope, $this->scopes);
    }
}
