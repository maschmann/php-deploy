<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoreBundle\Twig;

use Core\Config\ConfigManager;

/**
 * Class CoreExtension
 *
 * @package CoreBundle\Twig
 * @author maschmann@gmail.com
 */
class CoreExtension extends \Twig_Extension
{
    /**
     * @var \Core\Config\ConfigManager
     */
    private $configManager;

    /**
     * @param ConfigManager $configManager
     */
    public function __construct(ConfigManager $configManager)
    {
        $this->configManager = $configManager;
    }

    /**
     * register of callable methods
     *
     * @return array
     */
    public function getFunctions()
    {
        return array();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'core_extension';
    }
}
