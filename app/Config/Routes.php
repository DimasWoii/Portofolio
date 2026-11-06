<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Portofolio::index');
$routes->get('about', 'Portofolio::about');  // halaman About Me
$routes->get('experience', 'Portofolio::experience');
$routes->get('project', 'Portofolio::project');
$routes->get('skills', 'Portofolio::skills');
$routes->get('education', 'Portofolio::education');
$routes->get('certifications', 'Portofolio::certifications');