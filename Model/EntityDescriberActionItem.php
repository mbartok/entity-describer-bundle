<?php

namespace mbartok\EntityDescriberBundle\Model;

class EntityDescriberActionItem extends EntityDescriberAction
{
    private $routeName;

    private $routeParams;

    /**
     * @param $routeName
     * @param $routeParams
     * @param $label
     * @param $attributes
     */
    public function __construct($routeName, array $routeParams = [], $label, array $attributes = [])
    {
        parent::__construct($label, $attributes);
        $this->routeName = $routeName;
        $this->routeParams = $routeParams;
    }

    /**
     * @return mixed
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @param mixed $routeName
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }

    /**
     * @return array
     */
    public function getRouteParams()
    {
        return $this->routeParams;
    }

    /**
     * @param array $routeParams
     */
    public function setRouteParams($routeParams)
    {
        $this->routeParams = $routeParams;
    }
}