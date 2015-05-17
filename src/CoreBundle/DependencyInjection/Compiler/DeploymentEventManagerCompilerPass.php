<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class DeploymentEventManagerCompilerPass
 *
 * @package CoreBundle\DependencyInjection\Compiler
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class DeploymentEventManagerCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     * @throws \ErrorException
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('core.deployment.event_manager')) {
            return;
        }

        $definition = $container->getDefinition(
            'core.deployment.event_manager'
        );

        $taggedDeploymentStartServices = $container->findTaggedServiceIds(
            'core.deployment.start'
        );

        foreach ($taggedDeploymentStartServices as $id => $attributes) {
            if (!isset($attributes[0]['alias'])) {
                throw new \ErrorException('Please define an alias for ' . $id . ' service for mapping!');
            }

            $definition->addMethodCall(
                'addDeploymentStartEvent',
                [
                    new Reference($id),
                    $attributes[0]['alias'],
                ]
            );
        }

        $taggedDeploymentSuccessServices = $container->findTaggedServiceIds(
            'core.deployment.success'
        );

        foreach ($taggedDeploymentSuccessServices as $id => $attributes) {
            if (!isset($attributes[0]['alias'])) {
                throw new \ErrorException('Please define an alias for ' . $id . ' service for mapping!');
            }

            $definition->addMethodCall(
                'addDeploymentSuccessEvent',
                [
                    new Reference($id),
                    $attributes[0]['alias'],
                ]
            );
        }


        $taggedDeploymentEndServices = $container->findTaggedServiceIds(
            'core.deployment.end'
        );

        foreach ($taggedDeploymentEndServices as $id => $attributes) {
            if (!isset($attributes[0]['alias'])) {
                throw new \ErrorException('Please define an alias for ' . $id . ' service for mapping!');
            }

            $definition->addMethodCall(
                'addDeploymentEndEvent',
                [
                    new Reference($id),
                    $attributes[0]['alias'],
                ]
            );
        }


        $taggedDeploymentFailServices = $container->findTaggedServiceIds(
            'core.deployment.fail'
        );

        foreach ($taggedDeploymentFailServices as $id => $attributes) {
            if (!isset($attributes[0]['alias'])) {
                throw new \ErrorException('Please define an alias for ' . $id . ' service for mapping!');
            }

            $definition->addMethodCall(
                'addDeploymentFailEvent',
                [
                    new Reference($id),
                    $attributes[0]['alias'],
                ]
            );
        }
    }
}
