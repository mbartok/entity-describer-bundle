<?php

namespace mbartok\EntityDescriberBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Required;

/**
 * @Annotation
 * @Target("CLASS")
 */
class EntityDescriber
{
    /**
     * @Required
     *
     * @var string
     */
    public $describer;

    /**
     * @return string
     */
    public function getDescriber()
    {
        return $this->describer;
    }
}