<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CoreBundle\Controller;

use Core\Controller\BaseServiceController;

/**
 * Class HomeController
 *
 * @package CoreBundle\Controller
 */
class PageController extends BaseServiceController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction()
    {
        return $this->render(
            'dashboard',
            []
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function settingsAction()
    {
        return $this->render(
            'settings',
            []
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helpAction()
    {
        return $this->render(
            'help',
            []
        );
    }

    /**
     * Load deployments table
     *
     * @param int $amount
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardDeploymentsAction($amount = 20)
    {
        return $this->render(
            'dashboard-deployments.partial',
            [
                'deployments' => [],
            ]
        );
    }
}
