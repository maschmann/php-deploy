<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoreBundle\EventListener;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class UserEventListener
 *
 * @package CoreBundle\EventListener
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class UserEventListener implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var string
     */
    private $defaultRole;

    /**
     * @var string
     */
    private $defaultRedirect;

    /**
     * @param EntityManager $entityManager
     * @param UrlGeneratorInterface $router
     * @param string $defaultRole
     * @param string $defaultRedirect
     */
    public function __construct(
        EntityManager $entityManager,
        UrlGeneratorInterface $router,
        $defaultRole,
        $defaultRedirect
    ) {
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->defaultRole = $defaultRole;
        $this->defaultRedirect = $defaultRedirect;
    }

    /**
     * @{inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        ];
    }

    /**
     * Form event, validation success with pre-persisted data.
     *
     * @param FormEvent $event
     */
    public function onRegistrationSuccess(FormEvent $event)
    {
        $url = $this->router->generate($this->defaultRedirect);

        /** @var \CoreBundle\Entity\AdminUser $user */
        $user = $event->getForm()->getData();
        $user->addRole($this->defaultRole);
        $user->setEnabled(false);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->entityManager->clear($user);

        $event->setResponse(new RedirectResponse($url));
    }
}
