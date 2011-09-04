<?php

define('LIBRARY_PATH', APP_PATH . DS . 'libraries');

// 1. sanitise (remove magic quotes, slashes, global vars)
// 2. do the routing - convert path into controller and action
// 3. autoload objects
// 4. error level/reporting

// include routes
$routes = array();
$routes['#^/$#i'] = array('controller' => 'home', 'action' => 'index');
$routes['#^/home$#i'] = array('controller' => 'home', 'action' => 'index');
$routes['#^/home/index$#i'] = array('controller' => 'home', 'action' => 'index');
$routes['#^/users$#i'] = array('controller' => 'users', 'action' => 'index');
$routes['#^/users/new$#i'] = array('controller' => 'users', 'action' => 'add');
$routes['#^/users/create$#i'] = array('controller' => 'users', 'action' => 'create');
$routes['#^/users/([0-9]{1,5})$#i'] = array('controller' => 'users', 'action' => 'show');
$routes['#^/users/([0-9]{1,5})/edit$#i'] = array('controller' => 'users', 'action' => 'edit');
$routes['#^/users/([0-9]{1,5})/update$#i'] = array('controller' => 'users', 'action' => 'update');

$routes['#^/shows$#i'] = array('controller' => 'shows', 'action' => 'index');
$routes['#^/shows/new$#i'] = array('controller' => 'shows', 'action' => 'add');
$routes['#^/shows/create$#i'] = array('controller' => 'shows', 'action' => 'create');
$routes['#^/shows/([0-9]{1,5})$#i'] = array('controller' => 'shows', 'action' => 'show');
$routes['#^/shows/([0-9]{1,5})/tweets$#i'] = array('controller' => 'shows', 'action' => 'tweets');
$routes['#^/shows/([0-9]{1,5})/ajaxtweets$#i'] = array('controller' => 'shows', 'action' => 'ajaxtweets');

$routes['#^/session/new$#i'] = array('controller' => 'session', 'action' => 'add');
$routes['#^/session/create$#i'] = array('controller' => 'session', 'action' => 'create');
$routes['#^/session/destroy$#i'] = array('controller' => 'session', 'action' => 'destroy');

