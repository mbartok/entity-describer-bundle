<?php

namespace mbartok\EntityDescriberBundle;

use mbartok\EntityDescriberBundle\DependencyInjection\Compiler\EntityDescriberCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MbartokEntityDescriberBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new EntityDescriberCompilerPass());
    }
}