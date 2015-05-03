<?php
/*
 * This file is part of the sf-project-skeleton package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Controller;

use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BaseServiceController
 *
 * @package Core\Controller
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class BaseServiceController
{
    use TemplatePathTrait;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @param EngineInterface $templating
     * @param FormFactory $formFactory
     */
    public function __construct(
        EngineInterface $templating,
        FormFactory $formFactory
    ) {
        $this->formFactory = $formFactory;
        $this->templating = $templating;
    }

    /**
     * Renders a view. Stolen from Symfony controller
     *
     * @param string $view The view name or symfony/twig syntax
     * @param array $parameters An array of parameters to pass to the view
     * @param int $status
     * @param array $headers
     * @return Response A Response instance
     */
    public function render($view = 'index', array $parameters = [], $status = 200, array $headers = [])
    {
        return new Response(
            $this->templating->render(
                $this->getTemplatePath($view),
                $parameters
            ),
            $status,
            $headers
        );
    }
}
