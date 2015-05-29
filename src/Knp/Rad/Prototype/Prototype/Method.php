<?php

namespace Knp\Rad\Prototype\Prototype;

class Method
{
    /**
     * @var object|string
     */
    private $object;

    /**
     * @var string
     */
    private $method;

    /**
     * @param object|string $object
     * @param string        $method
     */
    public function __construct($object, $method)
    {
        $this->object = $object;
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        $object = $this->object;

        $object = true === $object instanceof Method
            ? $object()
            : $object
        ;

        return call_user_func_array([$object, $this->method], func_get_args());
    }
}
