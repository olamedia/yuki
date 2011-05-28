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
 * yRequest
 *
 * @package yuki
 * @subpackage request
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yRequest{
    protected $_get = array();
    protected $_post = array();
    protected $_server = array();
    public function setGetArray($array){
        $this->_get = $array;
        return $this;
    }
    public function setPostArray($array){
        $this->_post = $array;
        return $this;
    }
    public function setServerArray($array){
        $this->_server = $array;
        return $this;
    }
    public function getHttpHeader($name, $default = null){
        return $this->getServerParameter('HTTP_'.strtoupper(strtr($name, '-', '_')), $default);
    }
    public function getServerParameter($name, $default = null){
        return isset($this->_server[$name])?$this->_server[$name]:$default;
    }
    public function getMethod($default = null){
        return $this->getServerParameter('REQUEST_METHOD', $default);
    }
    public function isGet(){
        return $this->getMethod() == 'GET';
    }
    public function isPost(){
        return $this->getMethod() == 'POST';
    }
    public function isPut(){
        return $this->getMethod() == 'PUT';
    }
    public function isDelete(){
        return $this->getMethod() == 'DELETE';
    }
    public static function fromEnvironment(){
        $request = new yRequest();
        $request
                ->setGetArray($_GET)
                ->setPostArray($_POST)
                ->setServerArray($_SERVER)
        ;
        return $request;
    }
}

