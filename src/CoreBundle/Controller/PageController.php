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
        return $this->templating->renderResponse(
            $this->getTemplatePath('dashboard'),
            array(
                'deployments' => [],
            )
        );
    }
}
