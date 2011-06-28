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
 * yEvent
 *
 * @package yuki
 * @subpackage events
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yEvent implements ArrayAccess{
    protected $_subject = null;
    protected $_name = '';
    protected $_parameters = array();
    protected $_processed = false;
    protected $_value = null;
    public function __construct($name, $subject = null, $parameters = array()){
        $this->_name = $name;
        $this->_subject = $subject;
        $this->_parameters = $parameters;
    }
    public function setName($name){
        $this->_name = $name;
        return $this;
    }
    public function getName(){
        return $this->_name;
    }
    public function setSubject($subject){
        $this->_subject = $subject;
        return $this;
    }
    public function getSubject(){
        return $this->_subject;
    }
    public function setProcessed($processed = true){
        $this->_processed = (boolean) $processed;
        return $this;
    }
    public function isProcessed(){
        return $this->_processed;
    }
    public function setReturnValue($value){
        $this->_value = $value;
        return $this;
    }
    public function getReturnValue(){
        return $this->_value;
    }
    public function hasParameter($name){
        return array_key_exists($this->_parameters, $name);
    }
    public function removeParameter($name){
        unset($this->_parameters[$name]);
        return $this;
    }
    public function setParameter($name, $value){
        $this->_parameters[$name] = $value;
        return $this;
    }
    public function getParameter($name, $default = null){
        if (!array_key_exists($this->_parameters, $name)){
            return $default;
        }
        return $this->_parameters[$name];
    }
    public function setParameters($paramaters = array()){
        $this->_parameters = $paramaters;
        return $this;
    }
    public function getParameters(){
        return $this->_parameters;
    }
    public function hasParameters(){
        return!empty($this->_parameters);
    }
    public function removeParameters(){
        $this->_parameters = array();
        return $this;
    }
    public function offsetExists($offset){
        return $this->hasParameter($offset);
    }
    public function offsetSet($offset, $value){
        $this->setParameter($offset, $value);
    }
    public function offsetUnset($offset){
        $this->removeParameter($offset);
    }
    public function offsetGet($offset){
        return $this->getParameter($offset);
    }
}

