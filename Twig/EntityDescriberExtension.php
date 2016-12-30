<?php

namespace mbartok\EntityDescriberBundle\Twig;

use mbartok\EntityDescriberBundle\Manager\EntityDescriberManager;
use mbartok\EntityDescriberBundle\Model\Describable;
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

    public function entityDetailPath(Describable $entity = null, array $params = [])
    {
        if ($entity === null) {
            return '';
        }
        $describer = $this->manager->getDescriberByClass($entity);
        return $this->router->generate($describer->getRouteName($entity), array_merge($describer->getRouteParams($entity), $params));
    }

    public function entityLabel($entity)
    {
        if ($entity === null) {
            return '';
        }
        $describer = $this->manager->getDescriberByClass($entity);
        return $describer->getLabel($entity);
    }
}