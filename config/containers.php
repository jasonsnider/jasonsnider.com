<?php
/**
 * A configuration file for DI containers
 */

namespace Tinker;

///// Application Plugin //////

Di\IoCRegistry::register('ApplicationController', function() use (
        $Router,
        $Theme,
        $View
    ) {

    $plugin = $Router->getPlugin(true);
    $model = $Router->getPlugin(true);
    $controller = $Router->getController(true) . 'Controller';

    $class = "\\{$plugin}\\Controller\\{$controller}";
    $Model = "\\{$plugin}\\Model\\{$model}";

    $Controller = new $class($Theme, $View);
    $Controller->inject(new $Model());

    return $Controller;
});

///// Custom Containers //////

Di\IoCRegistry::register('PostsController', function() use (
        $Theme,
        $View
    ) {

    $Controller = new \Content\Controller\PostsController($Theme, $View);

    $config = Configure::read();
    $Controller->inject(new \Content\Model\Post($config));

    return $Controller;
});

Di\IoCRegistry::register('PagesController', function() use (
        $Theme,
        $View
    ) {

    $Controller = new \Content\Controller\PagesController($Theme, $View);

    return $Controller;
});

Di\IoCRegistry::register('ToolsController', function() use (
        $Theme,
        $View,
        $Loader
    ) {

    //Autoload the Jsc lib
    $Loader->addNamespace(
        "\Jsc", APP . DS . 'vendor' . DS. 'Jsc' . DS . 'src'
    );

    $Controller = new \Tools\Controller\ToolsController($Theme, $View);
    $Controller->inject(new \Jsc\Jibirish());
    $Controller->inject(new \Jsc\Security());

    return $Controller;
});
