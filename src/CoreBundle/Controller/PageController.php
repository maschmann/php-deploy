<?php
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
     * @return mixed
     */
    public function dashboardAction()
    {
        return $this->render(
            'dashboard',
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
