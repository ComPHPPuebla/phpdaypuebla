<?php
$app->get('/eventbrite/asistentes.html', function() use($app, $sm) {
    $eventBriteClient = $sm->get('client');
    if ($app->request()->isAjax()) {
        $params = array('attendeesCount' => $eventBriteClient->getEventAttendeesCount());
        $app->render('asistentes.html.twig', $params);
    }
})->name('asistentes');