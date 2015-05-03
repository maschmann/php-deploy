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
}
