<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Deployment;

use Asm\Data\Data;
use Core\Deployment\Event\DeploymentSuccessEvent;
use Core\Deployment\Event\DeploymentFailEvent;
use Core\Deployment\Event\DeploymentStartEvent;
use Core\Deployment\Event\DeploymentEndEvent;
use Core\Deployment\Event\EventInterface;
use Psr\Log\LoggerInterface;

/**
 * Class DeploymentEventManager
 *
 * @package Core\Deployment\Event
 * @author Marc Aschmann <maschmann@gmail.com>
 */
final class DeploymentEventManager extends Data
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param DeploymentStartEvent $event
     * @param string $alias
     * @return $this
     */
    public function addDeploymentStartEvent(DeploymentStartEvent $event, $alias)
    {
        $this->set('start', $alias, $event);

        return $this;
    }

    /**
     * @param string $alias
     * @return $this
     */
    public function removeDeploymentStartEvent($alias)
    {
        $this->set('start', $alias, []);

        return $this;
    }


    /**
     * @param string $alias
     * @return bool|DeploymentStartEvent
     */
    public function getDeploymentStartEvent($alias)
    {
        return $this->get('start', $alias);
    }

    /**
     * @return bool|array
     */
    public function getDeploymentStartEvents()
    {
        return $this->get('start', []);
    }


    /**
     * run all events before routing
     *
     * @param DeploymentStartEvent $event
     * @return $this
     */
    public function runDeploymentStartEvents(DeploymentStartEvent $event)
    {
        /** @var EventInterface $loadingEvent */
        foreach ($this->getDeploymentStartEvents() as $alias => $loadingEvent) {
            $this->logger->debug('DeploymentEventManager::runDeploymentStartEvents -> firing: ' . $alias);
            $loadingEvent->handle($event);
        }

        return $this;
    }

    /**
     * @param DeploymentEndEvent $event
     * @param string $alias
     * @return $this
     */
    public function addDeploymentEndEvent(DeploymentEndEvent $event, $alias)
    {
        $this->set('end', $alias, $event);

        return $this;
    }

    /**
     * @param string $alias
     * @return $this
     */
    public function removeDeploymentEndEvent($alias)
    {
        $this->set('end', $alias, []);

        return $this;
    }

    /**
     * @param string $alias
     * @return bool|DeploymentEndEvent
     */
    public function getDeploymentEndEvent($alias)
    {
        return $this->get('end', $alias);
    }

    /**
     * @return bool|array
     */
    public function getDeploymentEndEvents()
    {
        return $this->get('end', []);
    }

    /**
     * run all events after routing
     *
     * @param DeploymentEndEvent $event
     * @return $this
     */
    public function runDeploymentEndEvents(DeploymentEndEvent $event)
    {
        /** @var EventInterface $loadingEvent */
        foreach ($this->getDeploymentEndEvents() as $alias => $loadingEvent) {
            $this->logger->debug('DeploymentEventManager::runDeploymentEndEvents -> firing: ' . $alias);
            $loadingEvent->handle($event);
        }

        return $this;
    }

    /**
     * @param DeploymentSuccessEvent $event
     * @param string $alias
     * @return $this
     */
    public function addDeploymentSuccessEvent(DeploymentSuccessEvent $event, $alias)
    {
        $this->set('success', $alias, $event);

        return $this;
    }

    /**
     * @param string $alias
     * @return $this
     */
    public function removeDeploymentSuccessEvent($alias)
    {
        $this->set('success', $alias, []);

        return $this;
    }


    /**
     * @param string $alias
     * @return bool|DeploymentSuccessEvent
     */
    public function getDeploymentSuccessEvent($alias)
    {
        return $this->get('success', $alias);
    }

    /**
     * @return bool|array
     */
    public function getDeploymentSuccessEvents()
    {
        return $this->get('success', []);
    }


    /**
     * run all events before routing
     *
     * @param DeploymentSuccessEvent $event
     * @return $this
     */
    public function runDeploymentSuccessEvents(DeploymentSuccessEvent $event)
    {
        /** @var EventInterface $loadingEvent */
        foreach ($this->getDeploymentSuccessEvents() as $alias => $loadingEvent) {
            $this->logger->debug('DeploymentEventManager::runDeploymentSuccessEvents -> firing: ' . $alias);
            $loadingEvent->handle($event);
        }

        return $this;
    }

    /**
     * @param DeploymentFailEvent $event
     * @param string $alias
     * @return $this
     */
    public function addDeploymentFailEvent(DeploymentFailEvent $event, $alias)
    {
        $this->set('fail', $alias, $event);

        return $this;
    }

    /**
     * @param string $alias
     * @return $this
     */
    public function removeDeploymentFailEvent($alias)
    {
        $this->set('fail', $alias, []);

        return $this;
    }


    /**
     * @param string $alias
     * @return bool|DeploymentFailEvent
     */
    public function getDeploymentFailEvent($alias)
    {
        return $this->get('fail', $alias);
    }

    /**
     * @return bool|array
     */
    public function getDeploymentFailEvents()
    {
        return $this->get('fail', []);
    }


    /**
     * run all events before routing
     *
     * @param DeploymentFailEvent $event
     * @return $this
     */
    public function runDeploymentFailEvents(DeploymentFailEvent $event)
    {
        /** @var EventInterface $loadingEvent */
        foreach ($this->getDeploymentFailEvents() as $alias => $loadingEvent) {
            $this->logger->debug('DeploymentEventManager::runDeploymentFailEvents -> firing: ' . $alias);
            $loadingEvent->handle($event);
        }

        return $this;
    }
}
