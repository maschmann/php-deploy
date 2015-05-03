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

/**
 * Class BaseControllerTrait
 *
 * @package Core\Controller
 * @author Marc Aschmann <maschmann@gmail.com>
 */
trait TemplatePathTrait
{
    /**
     * get the template path for current bundle, controller and action
     *
     * @param string $method action name or namespace
     * @return string symfony formatted template path
     */
    public function getTemplatePath($method = 'index')
    {
        /**
         * true for SF application bundle controllers
         * classpath always consists of:
         *
         * n namespace_base\
         * 1 BundleNameBundle\
         * 1 Controller\
         * 1 ControllerNameController\
         *********************************************************************/
        $classPath  = explode('\\', get_called_class());
        $controller = str_replace('Controller', '', array_pop($classPath));
        if (3 == count($classPath)) {
            $namespace = array_shift($classPath);
        } else {
            $namespace = '';
        }
        array_pop($classPath); // remove "Controller"
        $bundle = str_replace('Bundle', '', array_pop($classPath));

        // check if action is __METHOD__ or simple string
        if (0 < strpos($method, '::')) {
            // extract action
            $context = explode(
                '::',
                str_replace(
                    'Action',
                    '',
                    $method
                )
            );
            $action  = $context[1];
        } else {
            $action = str_replace('Action', '', $method);
        }

        // return reconstructed template path NamespaceMyBundle:Controller:action.html.twig
        return $namespace . $bundle . 'Bundle:' . $controller . ':' . $action . '.html.twig';
    }
}
