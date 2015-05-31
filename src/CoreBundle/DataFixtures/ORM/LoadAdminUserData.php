<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\AdminUser;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadAdminUserData
 *
 * @package CoreBundle\DataFixtures\ORM
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class LoadAdminUserData extends AbstractFixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new AdminUser();

        $user
            ->setEnabled(true)
            ->setEmail('admin@php-deploy.com')
            ->setPlainPassword('admin')
            ->setUsername('admin')
            ->setRoles(
                [
                    'ROLE_DEPLOYMENT_USER',
                ]
            );

        $manager->persist($user);
        $manager->flush();
    }
}
