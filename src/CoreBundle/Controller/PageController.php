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
use CoreBundle\Entity\Project;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @param Request $request
     * @return Response
     */
    public function projectsAction(Request $request)
    {
        $projects = $this->getProjects();

        if ($request->isXmlHttpRequest()) {
            $template = 'projects-list';
        } else {
            $template = 'projects';
        }

        return $this->render(
            $template,
            [
                'projects' => $projects,
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function projectsNavAction()
    {
        $projects = $this->getProjects();

        return $this->render(
            'projects-nav',
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

    /**
     * @param string $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function formAction($id)
    {
        $action = 'core_project.form';

        if (null !== $id) {
            $project = $this->entityManager
                ->getRepository('CoreBundle:Project')
                ->findOneById($id);
        } else {
            $project = new Project();
        }

        $form = $this->formFactory->create('asm_project_form', $project, array());

        return $this->render(
            'project-form',
            [
                'form' => $form->createView(),
                'action' => $action,
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAction(Request $request)
    {
        return $this->handleForm('create', $request);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(Request $request)
    {
        return $this->handleForm('update', $request);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteAction(Request $request)
    {
        $error = array();
        $status = 200;

        $project = $this->entityManager#
            ->getRepository('CoreBundle:Project')
            ->findOneById(
                $request->request->get('id')
            );


        if (!empty($project)) {
            $this->entityManager->remove($project);
            $this->entityManager->flush();
            $this->entityManager->clear($project);
        } else {
            $error['message'] = 'project not found ' . json_encode($request->request->all());
            $status = 404;
        }

        return new JsonResponse(
            array_merge(
                array(
                    'status' => $status,
                ),
                $error
            ),
            $status
        );
    }

    /**
     * @param integer $limit
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    private function getProjects($limit = 20)
    {
        /** @var \CoreBundle\Entity\Project $projects */
        return $this->entityManager
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
    }

    /**
     * @param string $type
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function handleForm($type, $request)
    {
        $error = null;
        $form = $this->formFactory->create('asm_translation', new Translation(), array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager = $this->translationManager;

            if ('update' == $type) {
                /** @var \Asm\TranslationLoaderBundle\Entity\Translation $update */
                $update = $form->getData();
                // get translation from database again to keep date_created
                $translation = $manager->findTranslationBy(
                    array(
                        'transKey' => $update->getTransKey(),
                        'transLocale' => $update->getTransLocale(),
                        'messageDomain' => $update->getMessageDomain(),
                    )
                );

                $translation
                    ->setTransKey($update->getTransKey())
                    ->setTransLocale($update->getTransLocale())
                    ->setMessageDomain($update->getMessageDomain())
                    ->setTranslation($update->getTranslation());

                $manager->updateTranslation($translation);
            } else {
                $translation = $form->getData();
                $translation->setDateCreated(new \DateTime());
                try {
                    $manager->updateTranslation($translation);
                    $error = '';
                } catch (\Exception $e) {
                    $error = $e->getMessage();
                }
            }

            $response = new Response(
                $this->render(
                    'project-result',
                    [
                        'error' => $error,
                    ]
                )
            );
        } else {
            $response = new Response(
                $this->render(
                    'project-form',
                    [
                        'form' => $form->createView(),
                    ]
                )
            );
        }

        return $response;
    }
}
