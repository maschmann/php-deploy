<?php

namespace CoreBundle;

use CoreBundle\DependencyInjection\Compiler\DeploymentEventManagerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class CoreBundle
 *
 * @package CoreBundle
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class CoreBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DeploymentEventManagerCompilerPass());
    }
}
