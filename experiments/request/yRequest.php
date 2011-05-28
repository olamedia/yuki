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
    public static function fromEnvironment(){
        $request = new yRequest();
        $request
                ->setGetArray($_GET)
                ->setPostArray($_POST)
                ->setServerArray($_SERVER)
        ;
        return $request;
    }
    public static function isCli(){
        return (PHP_SAPI == 'cli');
    }
    public function getHttpHeader($name, $default = null){
        return $this->getServerParameter('HTTP_'.strtoupper(strtr($name, '-', '_')), $default);
    }
    public function getServerParameter($name, $default = null){
        if (func_num_args() > 2){
            // simplify multiple keys checking
            // Note: $default is required!
            // example getServerParameter('DOCUMENT_URI', 'REQUEST_URI', '');
            $args = func_get_args();
            $default = array_pop($args);
            foreach ($args as $name){
                if (isset($this->_server[$name])){
                    return $this->_server[$name];
                }
            }
            return $default;
        }
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
    public function isAjax(){
        return 'XMLHttpRequest' == $this->getHttpHeader('X-Requested-With');
    }
    public function getRequestUriString($default = ''){
        return $this->getServerParameter(
                        'DOCUMENT_URI', // nginx SSI REQUEST_URI = /
                        'REQUEST_URI', // common key
                        $default
        );
    }
    /**
     * Get domain name
     * @return string Domain name
     */
    public function getServerName($default = ''){
        return $this->getServerParameter(
                        'HTTP_HOST', // From Host: HTTP header
                        'SERVER_NAME', // From server_name directive
                        $default
        );
    }
    /**
     * Get domain name, !excluding www. prefix
     * @return string Domain name
     */
    public function getDomainName(){
        $da = explode(".", $this->getServerName());
        if (reset($da) == 'www'){
            array_shift($da);
        }
        return implode(".", $da);
    }
    public function getReferer($default = false){
        return $this->getServerParameter('HTTP_REFERER', $default);
    }
    public function getUseragent($default = ''){
        return $this->getServerParameter('HTTP_USER_AGENT', $default);
    }
}

