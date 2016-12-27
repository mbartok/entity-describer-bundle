<?php

namespace mbartok\EntityDescriberBundle\Twig;

use mbartok\EntityDescriberBundle\Manager\EntityDescriberManager;
use mbartok\EntityDescriberBundle\Model\EntityDescriberInterface;
use Symfony\Component\Routing\Router;

class EntityDescriberExtension extends \Twig_Extension implements \Twig_Extension_InitRuntimeInterface
{
    /**
     * @var EntityDescriberManager
     */
    private $manager;

    /**
     * @var Router
     */
    private $router;

    public function __construct(EntityDescriberManager $manager, Router $router)
    {
        $this->manager = $manager;
        $this->router = $router;
    }

    /**
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'mbartok_entity_describer';
    }

    /**
     *
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('entityDetailPath', array($this, 'entityDetailPath'), array(
                'is_safe' => array('html')
            )),
            new \Twig_SimpleFunction('entityLabel', array($this, 'entityLabel'), array(
                'is_safe' => array('html')
            ))
        );
    }

    /**
     * @param $entity
     * @return EntityDescriberInterface
     */
    private function getDescriber($entity)
    {
        $describer = $this->manager->getDescriber(get_class($entity));
        return $describer['describer'];
    }

    public function entityDetailPath($entity, array $params = [])
    {
        if ($entity === null) {
            return '';
        }
        $describer = $this->getDescriber($entity);
        return $this->router->generate($describer->getRouteName(), array_merge($describer->getRouteParams(), $params));
    }

    public function entityLabel($entity)
    {
        if ($entity === null) {
            return '';
        }
        $describer = $this->getDescriber($entity);
        return $describer->getLabel();
    }
}