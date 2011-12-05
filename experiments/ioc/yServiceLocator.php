<?php

/*
 * This file is part of the yuki package.
 * Copyright (c) 2011 olamedia <olamedia@gmail.com>
 *
 * Licensed under The MIT License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * yServiceLocator
 *
 * @package yuki
 * @subpackage ioc
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yServiceLocator{
    /**
     * Service locator instance
     * @var yServiceLocator
     */
    private static $_instance = null;
    /**
     * Services registry
     * @var yRegistry
     */
    private $_service = null;
    /**
     *
     * @var yServiceFactory
     */
    private $_factory = null;
    /**
     * Constructor
     */
    private function __construct(){
        $this->_service = new yRegistry();
        $this->_factory = new yServiceFactory();
    }
    /**
     * Gets service locator instance
     * @return yServiceLocator
     */
    public static function getInstance(){
        if (self::$_instance === null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    /**
     * Get service factory
     * @return yServiceFactory
     */
    public function getFactory(){
        return $this->_factory;
    }
    /**
     * Gets service by name
     * @param string $name
     * @return mixed
     */
    public function getService($name){
        $service = $this->_service->get($name, null);
        if (is_object($service) && $service instanceof yService){
            return $service->getInstance();
        }
        return null;
    }
    /**
     * Sets preconfigured service into locator (push)
     * @param string $name
     * @param mixed $service
     * @return yServiceLocator 
     */
    public function setService($name, $service){
        if (!($service instanceof yService)){
            $service = new yService($service);
        }
        $this->_service->set($name, $service);
        return $this;
    }
    public function hasService($id){
        return!!$this->_service->get($id, false);
    }
    /**
     * Registers service definition with given name
     * @param string $name Service name
     * @param string $class Service class name
     * @return yServiceDefinition
     */
    public function register($name, $class){
        $serviceDefinition =
                yServiceDefinition::create($name)
                ->setClass($class)
        ;
        $this->setService($name, $serviceDefinition);
        $serviceDefinition->end($this);
        return $serviceDefinition;
    }
}

