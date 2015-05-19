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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function projectsAction()
    {
        /** @var \CoreBundle\Entity\Project $projects */
        $projects = $this->entityManager
            ->getRepository('CoreBundle:AdminUser')
            ->findOneBy(
                [
                'id' => $this->security
                    ->getToken()
                    ->getUser()
                    ->getId()
                ]
            )
            ->getProjects();

        return $this->render(
            'projects',
            [
                'projects' => $projects,
            ]
        );
    }

    /**
     * @param integer $id project Id to find
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function projectAction($id)
    {
        $project = null;

        if (false === empty($id)) {
            $project = $this->entityManager
                ->getRepository('CoreBundle:Project')
                ->findOneBy(
                    [
                        'id' => $id,
                    ]
                );
        }

        return $this->render(
            'project',
            [
                'project' => $project,
            ]
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
