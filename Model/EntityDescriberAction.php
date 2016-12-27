<?php

namespace mbartok\EntityDescriberBundle\Model;

class EntityDescriberAction
{
    private $routeName;

    private $routeParams;

    private $label;

    private $attributes;

    /**
     * @param $routeName
     * @param $routeParams
     * @param $label
     * @param $attributes
     */
    public function __construct($routeName, array $routeParams = [], $label, array $attributes = [])
    {
        $this->routeName = $routeName;
        $this->routeParams = $routeParams;
        $this->label = $label;
        $this->attributes = $attributes;
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
     * @return EntityDescriberAction
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
        return $this;
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
     * @return EntityDescriberAction
     */
    public function setRouteParams($routeParams)
    {
        $this->routeParams = $routeParams;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return EntityDescriberAction
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return EntityDescriberAction
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }
}