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

use Core\Ansible\AnsibleServiceInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
     * @var ObjectManager
     */
    protected $entityManager;

    /**
     * @var TokenStorageInterface
     */
    protected $security;

    /**
     * @var AnsibleServiceInterface
     */
    protected $ansible;

    /**
     * @var string
     */
    protected $ansibleRoot;

    /**
     * @param EngineInterface $templating
     * @param FormFactory $formFactory
     * @param ObjectManager $objectManager
     * @param TokenStorageInterface $tokenStorage
     * @param AnsibleServiceInterface $ansible
     * @param string $ansibleRoot
     */
    public function __construct(
        EngineInterface $templating,
        FormFactory $formFactory,
        ObjectManager $objectManager,
        TokenStorageInterface $tokenStorage,
        AnsibleServiceInterface $ansible,
        $ansibleRoot
    ) {
        $this->formFactory = $formFactory;
        $this->templating = $templating;
        $this->entityManager = $objectManager;
        $this->security = $tokenStorage;
        $this->ansible = $ansible;
        $this->ansibleRoot = $ansibleRoot;
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
