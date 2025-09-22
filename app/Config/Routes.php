<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::registerUser');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginUser');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'DashboardController::index');
    $routes->get('/movies/details/(:num)', 'MoviesController::details/$1');
    $routes->get('/tvs/details/(:num)', 'TvsController::details/$1');
    $routes->get('/movies/add-to-list/(:num)', 'ListController::addToUserList/$1');
    $routes->get('/movies/remove-from-list/(:num)', 'ListController::removeFromUserList/$1');
    $routes->get('/tvs/add-to-list/(:num)', 'ListController::addToUserTvList/$1');
    $routes->get('/tvs/remove-from-list/(:num)', 'ListController::removeFromUserTvList/$1');
    $routes->get('/list', 'ListController::userList');
    $routes->post('/reviews/addMovieReview/(:num)', 'ReviewsController::addMovieReview/$1');
    $routes->post('/reviews/addTvReview/(:num)', 'ReviewsController::addTvReview/$1');
    $routes->post('/reviews/deleteMovieReview/(:num)', 'ReviewsController::deleteMovieReview/$1');
    $routes->post('/reviews/deleteTvReview/(:num)', 'ReviewsController::deleteTvReview/$1');
    $routes->post('/reviews/editMovieReview/(:num)', 'ReviewsController::updateMovieReview/$1');
    $routes->post('/reviews/editTvReview/(:num)', 'ReviewsController::updateTvReview/$1');
    $routes->get('/reviews', 'ReviewsController::index');
});
