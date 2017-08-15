<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);



    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */

/**
 * REST API --> Routes
 */

Router::scope('/api', function ($routes) {
    $routes->extensions(['json']);
    $routes->resources('Books');
    $routes->resources('Users');
    $routes->resources('Publishers');
    $routes->resources('Tags');
    $routes->resources('Orders');
    $routes->resources('Raitings');
    $routes->resources('OrdersItems');


    $routes->connect('/login', ['controller'=>'Login','action'=>'index', '[method]'=>'POST']);
    $routes->connect('/login', ['controller'=>'Login','action'=>'logout', '[method]'=>'DELETE']);

    /**
     * get books by isbn
     */
    $routes->connect('/books/isbn/:isbn',
        ['controller' => 'Books', 'action' => 'isbn', '[method]' => 'GET'],
        [ 'pass' => ['isbn'],
            // Define a pattern that `id` must match.
            //'isbn' => '[0-9]+'
        ]);

    /**
     * delete books by isbn
     */

    $routes->connect('/books/isbn/:isbn',
        ['controller' => 'Books', 'action' => 'deleteByISBN', '[method]' => 'DELETE'],
        [ 'pass' => ['isbn']
        ]);

    /**
     * update books by isbn
     */
    $routes->connect('/books/isbn/:isbn',
        ['controller' => 'Books', 'action' => 'updateByISBN', '[method]' => 'PUT'],
        [ 'pass' => ['isbn'],
            // Define a pattern that `id` must match.
            //'isbn' => '[0-9]+'
        ]);

    $routes->connect('/books/tag/:tag',
        ['controller' => 'Books', 'action' => 'tag'],
        [ 'pass' => ['tag'],
            // Define a pattern that `id` must match.
            // 'tag' => '[0-9][a-z]+'
        ]);

    $routes->connect('/tags/:tag',
        ['controller' => 'Tags', 'action' => 'tagByName'],
        [ 'pass' => ['tag']]);

    $routes->connect('/publishers/id/:id',
        ['controller' => 'Publisher', 'action' => 'deleteById', '[method]' => 'DELETE'],
        [ 'pass' => ['id']
        ]);


    /**
     * get raitings by isbn
     */
    $routes->connect('/raitings/isbn/:isbn',
        ['controller' => 'Raitings', 'action' => 'isbn', '[method]' => 'GET'],
        [ 'pass' => ['isbn'],
            // Define a pattern that `id` must match.
            //'isbn' => '[0-9]+'
        ]);


    /**
    * get orders by user id
    */
    $routes->connect('/orders/userid/:id',
        ['controller' => 'Orders', 'action' => 'userid', '[method]' => 'GET'],
        [ 'pass' => ['id'],
            // Define a pattern that `id` must match.
            //'isbn' => '[0-9]+'
        ]);

    /**
     * get orderitems by order id
     */
    $routes->connect('/orderitems/orderid/:id',
        ['controller' => 'OrdersItems', 'action' => 'orderid', '[method]' => 'GET'],
        [ 'pass' => ['id'],
            // Define a pattern that `id` must match.
            //'isbn' => '[0-9]+'
        ]);

    $routes->connect('/orders/getlastid',
        ['controller' => 'Orders', 'action' => 'getlastid', '[method]' => 'GET']);



});

// PAGES Routes
Router::scope('/',  ['controller' => 'Pages'], function($routes) {
    $routes->extensions('json');
    $routes->connect('/forbidden', ['action'=>'forbidden']);
    $routes->connect('/unauthorized', ['action'=>'unauthorized']);
});


Plugin::routes();
