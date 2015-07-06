<?php

namespace Knp\Rad\Prototype\DataCollector;

use Knp\Rad\Prototype\Prototype;
use Knp\Rad\Prototype\Prototype\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Context;

class PrototypeCollector extends DataCollector
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

    public function onController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (true === is_array($controller)) {
            $controller = current($controller);
        }

        if (false === $controller instanceof Prototype) {
            return;
        }

        $this->data['controller'] = get_class($controller);
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        foreach ($this->container->getMethods() as $domain => $methods) {
            foreach ($methods as $alias => $method) {
                $rflMethod = $method->getReflection();
                $rflClass  = $rflMethod->getDeclaringClass();

                $context       = new Context($rflClass->getNamespaceName(), [], $rflClass->getShortName());
                $documentation = new DocBlock($rflMethod, $context);

                $this->data['methods'][$alias] = [
                    'alias'         => $alias,
                    'documentation' => $documentation,
                    'domain'        => $domain,
                    'method'        => $rflMethod->getName(),
                ];
            }
        }
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->data['methods'];
    }

    public function getPrototypeController()
    {
        if (false === array_key_exists('controller', $this->data)) {
            return null;
        }

        return $this->data['controller'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'knp_rad_prototype';
    }
}
