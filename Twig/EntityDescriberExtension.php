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

    /**
     * @var string
     */
    private $template;

    public function __construct(EntityDescriberManager $manager, Router $router, $template)
    {
        $this->manager = $manager;
        $this->router = $router;
        $this->template = $template;
    }

    /**
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'mbartok_entity_describer';
    }

    /**
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
            )),
            new \Twig_SimpleFunction('entityActionDropdown', array($this, 'entityActionDropdown'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            )),
            new \Twig_SimpleFunction('entityActionButtons', array($this, 'entityActionButtons'), array(
                'is_safe' => array('html'),
                'needs_environment' => true
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

    public function entityLabel(Describable $entity)
    {
        if ($entity === null) {
            return '';
        }
        $describer = $this->manager->getDescriberByClass($entity);
        return $describer->getLabel($entity);
    }

    public function entityActionDropdown(\Twig_Environment $twig, Describable $entity)
    {
        if ($entity === null) {
            return '';
        }
        $describer = $this->manager->getDescriberByClass($entity);
        $renderer = $twig->load($this->template);
        return $renderer->renderBlock('dropdown', array(
            'entity' => $entity,
            'actions' => $describer->getActions($entity)
        ));
    }

    public function entityActionButtons(\Twig_Environment $twig, Describable $entity)
    {
        if ($entity === null) {
            return '';
        }
        $describer = $this->manager->getDescriberByClass($entity);
        $renderer = $twig->load($this->template);
        return $renderer->renderBlock('buttons', array(
            'entity' => $entity,
            'actions' => $describer->getActions($entity)
        ));
    }
}