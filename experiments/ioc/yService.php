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
 * yService
 * Internal service representation
 * 
 * @internal
 * @package yuki
 * @subpackage ioc
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yService{
    private $_definition = null;
    private $_instance = null;
    public function __construct($object){
        if ($object instanceof yServiceDefinition){
            $this->_definition = $object;
        }else{
            $this->_instance = $object;
        }
    }
    public function setDefinition($definition){
        $this->_definition = $definition;
        return $this;
    }
    public function setInstance($instance){
        $this->_instance = $instance;
        return $this;
    }
    public function getInstance(){
        if ($this->hasDefinition()){
            // if Singleton without instance || Prototype
            if ((!$this->hasInstance()) || $this->_definition->isPrototype()){
                // use factory to create instance
                $this->_instance = yServiceLocator::getInstance()
                        ->getFactory()
                        ->assembly($this->_definition);
            }
        }
        return $this->_instance;
    }
    public function hasDefinition(){
        return $this->_definition !== null;
    }
    public function hasInstance(){
        return $this->_instance !== null;
    }
}

