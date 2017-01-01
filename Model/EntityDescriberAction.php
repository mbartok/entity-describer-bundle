<?php

namespace mbartok\EntityDescriberBundle\Model;

abstract class EntityDescriberAction
{
    private $label;

    private $attributes;

    public function __construct($label, array $attributes = [])
    {
        $this->label = $label;
        $this->attributes = $attributes;
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
     */
    public function setLabel($label)
    {
        $this->label = $label;
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
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }
}