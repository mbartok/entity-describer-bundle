<?php

namespace mbartok\EntityDescriberBundle\Model;

interface EntityDescriberInterface
{
    /**
     * @return string
     */
    public function getRouteName();

    /**
     * @return array
     */
    public function getRouteParams();

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @return EntityDescriberAction[]
     */
    public function getActions();
}