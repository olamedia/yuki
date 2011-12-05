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
 * yServiceFactory
 *
 * @package yuki
 * @subpackage ioc
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yServiceFactory{
    public function __construct(){
        ;
    }
    private function _invokeReflectionMethod($reflectionClass, $reflectionMethod, &$arguments){
        $parameters = $reflectionMethod->getParameters();
        $realArguments = array();
        foreach ($parameters as $key=>$parameter){
            if ($parameter->isPassedByReference()){
                $realArguments[$key] = &$arguments[$key];
            }else{
                $realArguments[$key] = $arguments[$key];
            }
        }
        return $reflectionClass->newInstanceArgs((array) $realArguments);
    }
    /**
     * Assembly service using given definition
     * @param yServiceDefinition $definition 
     */
    public function assembly($definition){
        $class = $definition->getClass();
        if ($definition->hasArguments()){
            $arguments = $definition->getArguments();
            $reflectionClass = new ReflectionClass($class);
            $constructor = new ReflectionMethod($class_name, '__construct');
            $service = $this->_invokeReflectionMethod($reflectionClass, $constructor, $arguments);
        }else{
            $service = new $class();
        }
        if ($definition->hasProperties()){
            $properties = $definition->getProperties();
            foreach ($properties as $name=>$value){
                if (is_object($value) && $value instanceof yServiceReference){
                    $value = $value->getService();
                }
                $service->{$name} = $value;
            }
        }
        return $service;
    }
}

