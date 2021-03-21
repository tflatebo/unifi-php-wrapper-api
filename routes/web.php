<?php

/** @var \Laravel\Lumen\Routing\Router $router */

require_once __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});*/

$router->group(['prefix'=>''], 
function() use($router)
    {
        $router->get('/', 'Controller@index');
        $router->get('/firewallrules', 'Controller@listfirewallrules');
        $router->get('/firewallrules/{id}', 'Controller@showfirewallrule');
        $router->put('/firewallrules/{id}', 'Controller@updatefirewallrule');
    }
);