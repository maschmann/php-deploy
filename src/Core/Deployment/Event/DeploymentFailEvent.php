<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Deployment\Event;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Class DeploymentFailEvent
 *
 * @package Core\Deployment\Event
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class DeploymentFailEvent extends AbstractDeploymentEvent
{
    /**
     * @var \Symfony\Component\HttpKernel\Event\FilterResponseEvent
     */
    protected $event;

    /**
     * @param FilterResponseEvent $event
     * @return $this
     */
    public function setEvent(FilterResponseEvent $event)
    {
        $this->event = $event;

        return $this;
    }
}
