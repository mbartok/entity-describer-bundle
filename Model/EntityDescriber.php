<?php

namespace mbartok\EntityDescriberBundle\Model;

interface EntityDescriber
{
    /**
     * @param Describable $entity
     * @return string
     */
    public function getRouteName(Describable $entity);

    /**
     * @param Describable $entity
     * @return array
     */
    public function getRouteParams(Describable $entity);

    /**
     * @param Describable $entity
     * @return string
     */
    public function getLabel(Describable $entity);

    /**
     * @param Describable $entity
     * @return EntityDescriberAction[]
     */
    public function getActions(Describable $entity);
}