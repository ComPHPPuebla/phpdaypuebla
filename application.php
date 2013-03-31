<?php
chdir(__DIR__);
require 'vendor/autoload.php';

use \Slim\Slim;
use \Zend\ServiceManager\Config;
use \Zend\ServiceManager\ServiceManager;

$configuration = new Config(require 'config/dic.config.php');
$sm = new ServiceManager($configuration);

$app = new Slim(require 'config/app.config.php');
$app->setName('PHP Day Puebla 2013');

require 'routes/static.php';
require 'routes/eventbrite.php';