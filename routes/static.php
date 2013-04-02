<?php
$app->get('/', function() use($app) {
    $app->render('index.html.twig');
})->name('index');
$app->get('/conferencistas.html', function() use($app) {
    $app->render('conferencistas.html.twig');
})->name('conferencistas');
$app->get('/sesiones.html', function() use($app) {
    $app->render('sesiones.html.twig');
})->name('sesiones');
$app->get('/sede.html', function() use($app) {
    $app->render('sede.html.twig');
})->name('sede');
$app->get('/comunidades.html', function() use($app) {
    $app->render('comunidades.html.twig');
})->name('comunidades');
$app->get('/staff.html', function() use($app) {
    $app->render('staff.html.twig');
})->name('staff');
