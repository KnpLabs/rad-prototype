<?php

namespace Knp\Rad\Prototype\Prototype;

use Knp\Rad\Prototype\Prototype;

class Container
{
    /**
     * @var array
     */
    private $methods;

    public function __construct()
    {
        $this->methods = [];
    }

    /**
     * @param string $alias
     * @param Method $method
     * @param string $domain
     *
     * @return
     */
    public function addMethod($alias, Method $method, $domain)
    {
        $this->methods[$domain][$alias] = $method;
    }

    /**
     * @param Prototype $prototype
     *
     * @return void
     */
    public function applyTo(Prototype $prototype)
    {
        foreach ($this->methods as $domain => $methods) {
            if (false === $prototype->canReach($domain)) {
                continue;
            }

            foreach ($methods as $alias => $method) {
                $prototype->$alias = $method;
            }
        }
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }
}
