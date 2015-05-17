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

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class DeploymentEvent
 *
 * @package Core\Deployment\Event
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class AbstractDeploymentEvent extends Event
{
    /**
     * @return GetResponseEvent
     */
    public function getEvent()
    {
        return $this->event;
    }
}
