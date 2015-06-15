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
        $object = true === $object instanceof self
            ? $object()
            : $object
        ;

        $this->object = $object;
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return call_user_func_array([$this->object, $this->method], func_get_args());
    }

    /**
     * @return \ReflectionMethod
     */
    public function getReflection()
    {
        return new \ReflectionMethod($this->object, $this->method);
    }
}
