<?php
/**
 * Application's dependency injection configuration
 *
 * PHP version 5.3
 *
 * @author     LMV <montealegreluis@gmail.com>
 * @copyright  Comunidad PHP Puebla 2013
 * @license    MIT
 */
use \Zend\ServiceManager\ServiceManager;
use \Slim\Extras\Views\Twig;
use \Guzzle\Http\Client;
use \ComPHPPuebla\EventBrite\EventBriteClient;

return array(
    'factories' => array(
        'twig' => function(ServiceManager $sm) {
            Twig::$twigOptions = array(
                'charset' => 'utf-8',
                'cache' => realpath('./templates/cache'),
                'auto_reload' => true,
                'strict_variables' => false,
                'autoescape' => true
            );

            Twig::$twigTemplateDirs = array(
                realpath('./templates'),
            );

            Twig::$twigExtensions = array(
                'Twig_Extensions_Slim',
            );

            return new Twig();
        },
        'client' => function(ServiceManager $sm) {
            $eventBriteClient = new EventBriteClient(require 'config/eventbrite.config.php');
            $eventBriteClient->setClient(new Client());

            return $eventBriteClient;
        },
    ),
);