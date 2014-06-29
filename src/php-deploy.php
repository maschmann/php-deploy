<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Acme\Console\Command\DeployCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new DeployCommand);
$application->run();
