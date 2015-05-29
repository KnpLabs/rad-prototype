<?php

namespace Knp\Rad\Prototype\EventListener;

use Knp\Rad\Prototype\Prototype;
use Knp\Rad\Prototype\Prototype\Container;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class ControllerAsPrototypeListener
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param FilterControllerEvent $event
     *
     * @return
     */
    public function onController(FilterControllerEvent $event)
    {
        $callable = $event->getController();

        if (true === is_array($callable)) {
            $callable = current($callable);
        }

        if (true === $callable instanceof Prototype) {
            $this->container->applyTo($callable);
        }
    }
}
