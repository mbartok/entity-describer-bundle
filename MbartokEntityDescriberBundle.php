<?php

namespace mbartok\EntityDescriberBundle;

use mbartok\EntityDescriberBundle\DependencyInjection\Compiler\AddEntityDescriberCompilerPass;
use mbartok\EntityDescriberBundle\DependencyInjection\Compiler\AddExtensionsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MbartokEntityDescriberBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddEntityDescriberCompilerPass());
        $container->addCompilerPass(new AddExtensionsPass());
    }
}