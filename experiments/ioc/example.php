<?php

include '../../tools/internalBootstrap.php';
include 'yServiceDefinition.php';
include 'yServiceFactory.php';
include 'yServiceLocatorException.php';
include 'yServiceLocator.php';
include 'yService.php';
include 'yServiceReference.php';

class myMailer{
    public $name = '';
    public $backend = null;
}

class myBackend{
    
}

$sl = yServiceLocator::getInstance()
        ->register('mailer', 'myMailer')
        ->setScope(yServiceDefinition::SCOPE_PROTOTYPE)
        ->setProperty('name', 'myname')
        ->setProperty('backend', new yServiceReference('my.backend'))
        ->end()
        ->register('my.backend', 'myBackend')
        ->setScope(yServiceDefinition::SCOPE_SINGLETON)
        ->end()
;

$mailer = $sl->getService('mailer');

var_dump($mailer);

$mailer = $sl->getService('mailer');

var_dump($mailer);

$mailer = $sl->getService('my.backend');

var_dump($mailer);

$mailer = $sl->getService('my.backend');

var_dump($mailer);

