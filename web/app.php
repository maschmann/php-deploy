<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

$serverEnv = getenv('APP_ENVIRONMENT');
$serverDebug = (bool)getenv('APP_DEBUG');
$serverName = $_SERVER['HTTP_HOST']; // think of proxy forwarding and ip address

if (empty($serverEnv)) {
    $serverEnv = 'prod';
}

// Use APC for autoloading to improve performance.
// Change 'sf2' to a unique prefix in order to prevent cache key conflicts
// with other applications also using APC.
/*if ('dev' != $serverEnv) {
    $apcLoader = new ApcClassLoader('sf2#', $loader);
    $loader->unregister();
    $apcLoader->register(true);
}*/

require_once __DIR__.'/../app/AppKernel.php';
require_once __DIR__.'/../app/AppCache.php';

$kernel = new AppKernel($serverEnv, $serverDebug);
$kernel->loadClassCache();

if ('dev' != $serverEnv) {
    $kernel = new AppCache($kernel);
}

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
