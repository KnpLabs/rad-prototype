<?php

namespace Knp\Rad\Prototype\DataCollector;

use Knp\Rad\Prototype\Prototype\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use phpDocumentor\Reflection\DocBlock;

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

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        foreach ($this->container->getMethods() as $domain => $methods) {
            foreach ($methods as $alias => $method) {
                $documentation = new DocBlock($method->getReflection());

                $this->data[$alias] = [
                    'alias'         => $alias,
                    'documentation' => $documentation,
                    'domain'        => $domain,
                ];
            }
        }
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'knp_rad_prototype';
    }
}
