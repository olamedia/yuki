<?php

/*
 * This file is part of the yuki package.
 * Copyright (c) 2011 olamedia <olamedia@gmail.com>
 *
 * This source code is release under the MIT License.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * yRegistry - advanced registry
 *
 * @package yuki
 * @subpackage registry
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yRegistry implements ArrayAccess, IteratorAggregate{
    protected $_map = array(); //'default'=>array('response', 'name')
    protected $_results = array();
    /**
     * Replaces registry data
     * @param array $map
     * @return yRegistry 
     */
    public function load($map){
        $this->_map = $map;
        return $this;
    }
    public function offsetExists($offset){
        return $this->has($offset);
    }
    public function offsetGet($offset){
        return $this->get($offset);
    }
    public function offsetSet($offset, $value){
        $this->set($offset, $value);
    }
    public function offsetUnset($offset){
        $this->remove($offset);
    }
    public function getIterator(){
        return new ArrayIterator($this->_map);
    }
    public function __get($name){
        return $this->get($name);
    }
    public function __set($name, $value){
        $this->set($name, $value);
    }
    public function __isset($name){
        return $this->has($name);
    }
    public function __unset($name){
        $this->remove($name);
    }
    public function append($name, $value){
        if (!is_string($name)){
            $name = strval($name);
        }
        if (!isset($this->_map[$name]) || !is_string($this->_map[$name]))
            $this->_map[$name] = '';
        $this->_map[$name] .= $value;
    }
    public function has($name){
        if (!is_string($name)){
            $name = strval($name);
        }
        return array_key_exists($name, $this->_map);
    }
    public function remove($name){
        if (!is_string($name)){
            $name = strval($name);
        }
        unset($this->_map[$name]);
    }
    public function set($name, $value = null){
        if (!is_string($name)){
            $name = strval($name);
        }
        $this->_map[$name] = $value;
    }
    public function get($name, $default = null){
        if (!is_string($name)){
            $name = strval($name);
        }
        return isset($this->_map[$name])?$this->_map[$name]:$default;
    }
    public function push($name, $value = null){
        if (!is_string($name)){
            $name = strval($name);
        }
        if (!isset($this->_map[$name])){
            $this->_map[$name] = array();
        }
        if (is_object($value)){
            $this->_map[$name]["$value"] = $value;
        }else{
            $this->_map[$name][$value] = $value;
        }
    }
    public function call($name, $default = null){
        if (!is_string($name)){
            $name = strval($name);
        }
        if ($default === null){
            $default = $this->get('default');
        }
        $args = func_get_args();
        array_shift($args);
        array_shift($args);
        $callable = $this->get($name, $default);
        if ($callable === $default){
            array_unshift($args, $name);
        }
        unset($default);
        if ($callable !== null){
            if (is_callable($callable)){
                return call_user_func_array($callable, $args);
            }
            if (is_string($callable)){
                if (is_file($callable)){
                    return include $callable;
                }
            }
        }
        ob_start();
        var_dump($name);
        $dump = ob_get_contents();
        ob_end_clean();
        throw new Exception('No such callable was registered: '.$dump);
    }
    public function callResult($name){
        if (!is_string($name)){
            $name = strval($name);
        }
        if (array_key_exists($name, $this->_map)){
            $callback = $this->_map[$name];
            $args = func_get_args();
            array_shift($args);
            return $this->resultArray($callback, $args);
        }
        ob_start();
        var_dump($name);
        $dump = ob_get_contents();
        ob_end_clean();
        throw new Exception('No such callable was registered: '.$dump);
    }
    public function result($callback){
        $args = func_get_args();
        array_shift($args);
        return $this->resultArray($callback, $args);
    }
    public function resultArray($callback, $args){
        if (!is_callable($callback, false, $name)){
            throw new Exception(printf($callback, true).' is not callable');
        }
        if (is_object($callback)){
            $name .= ':'.spl_object_hash($callback);
        }
        $hash = md5($name.serialize($args));
        if (!isset($this->_results[$hash])){
            $this->_results[$hash] = call_user_func_array($callback, $args);
        }
        return $this->_results[$hash];
    }
}

