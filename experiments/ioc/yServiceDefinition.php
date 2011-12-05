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
 * yServiceDefinition
 * 
 * DI Support
 * ♥ - Favorite feature
 * ◦ - Not supported
 * ✔ - Supported
 * 
 * ♥ ✔ Constructor Injection
 * ♥   ◦ Custom Static Constructor Method (ex getInstance)
 * ♥ ◦ Method Injection
 * ♥ ✔ Property Injection
 *     ◦ Setter Injection
 *   ◦ Custom Factory Class Static Method
 *   ◦ Custom Factory Object Method
 *   ◦ Custom Configurator Callable (post-configuration)
 *       function: <configurator function="configure" />
 *       service method: <configurator service="baz" method="configure" />
 *       static method: <configurator class="BazClass" method="configureStatic" />
 *   ◦ Include file before construction
 *   ◦ Annotated Method
 *   ◦ Annotated Field
 *   ✖ Named Field (Fields of a certain name should be injected into)
 *   ✖ Named Method (If method names match other component names, injection happens)
 *   ✖ Typed Field (Fields of a certain type should be injected into)
 * Misc:
 * ♥ ✔ References
 * ♥ ◦ Parameters, placeholders
 * ♥ ◦ Anonymous services (without manually given id)
 *   ◦ Aliases
 *   ◦ Imports (Preload another configuration files)
 *   ◦ Shutdown method (destructor)
 *   ◦ Aware Interfaces
 *
 * @package yuki
 * @subpackage ioc
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yServiceDefinition{
    const
    SCOPE_SINGLETON = 0,
    SCOPE_PROTOTYPE = 1
    ;
    /**
     * The unique identifier of the service
     * @var string 
     */
    private $_name = null;
    /**
     * Full class name (including namespace)
     * @var string
     */
    private $_class = null;
    private $_scope = self::SCOPE_PROTOTYPE;
    private $_argument = array();
    private $_property = array();
    private $_endPoint = null; // for chainable methods
    private function __construct(){
        
    }
    /**
     * Creates new definition
     * @param string $name
     * @return yServiceDefinition 
     */
    public static function create($name){
        $definition = new self();
        $definition->setName($name);
        return $definition;
    }
    public function setName($name){
        $this->_name = $name;
        return $this;
    }
    public function getName(){
        return $this->_name;
    }
    /**
     * Sets the service class.
     * @param string $class
     * @return yServiceDefinition 
     */
    public function setClass($class){
        $this->_class = $class;
        return $this;
    }
    public function getClass(){
        return $this->_class;
    }
    public function setScope($scope){
        $this->_scope = $scope;
        return $this;
    }
    public function getScope(){
        return $this->_scope;
    }
    public function isSingleton(){
        return $this->_scope === self::SCOPE_SINGLETON;
    }
    public function isPrototype(){
        return $this->_scope === self::SCOPE_PROTOTYPE;
    }
    public function setProperty($name, $value){
        $this->_property[$name] = $value;
        return $this;
    }
    public function getProperty($name, $default = null){
        return array_key_exists($name, $this->_property)?$this->_property[$name]:$default;
    }
    public function getProperties(){
        return $this->_property;
    }
    public function hasProperties(){
        return!empty($this->_property);
    }
    public function setArguments($valueArray){
        $this->_argument = $valueArray;
        return $this;
    }
    /**
     * Adds an argument for the constructor.
     */
    public function addArgument($value){
        $this->_argument[] = $value;
        return $this;
    }
    public function getArguments(){
        return $this->_argument;
    }
    public function hasArguments(){
        return!empty($this->_argument);
    }
    /**
     * @param yServiceLocator $endPoint
     * @return yServiceLocator 
     */
    public function end($endPoint = null){
        if ($endPoint !== null){
            $this->_endPoint = $endPoint;
        }else{
            $endPoint = $this->_endPoint;
            $this->_endPoint = null;
        }
        return $endPoint;
    }
    /**
     * Sets the static method to use when the service is created, 
     * instead of the standard new construct
     */
    public function setConstructor(){
        
    }
    /**
     * Sets a file to include before creating a service
     */
    public function setFile(){
        
    }
    public function setMethodCalls(){
        
    }
    public function addMethodCall(){
        
    }
    /**
     * Sets a PHP callable to call after the service has been configured.
     */
    public function setConfigurator(){
        
    }
}

