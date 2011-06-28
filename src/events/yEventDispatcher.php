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
 * yEventDispatcher
 *
 * @package yuki
 * @subpackage events
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yEventDispatcher implements ArrayAccess{
    protected $_listeners = array();
    public function attach($name, $listener){
        if (is_callable($listener)){
            if (!isset($this->_listeners[$name]))
                $this->_listeners[$name] = array();
            $this->_listeners[$name][] = $listener;
        }
        return $this;
    }
    public function detach($name, $listener){
        if (!isset($this->_listeners[$name]))
            return false;
        foreach ($this->_listeners[$name] as $k=>$attachedListener){
            if ($listener === $attachedListener){
                unset($this->_listeners[$name][$k]);
            }
        }
        return $this;
    }
    public function hasListeners($name){
        if (!isset($this->_listeners[$name])){
            return false;
        }
        return!empty($this->_listeners[$name]);
    }
    public function getListeners($name){
        if (!isset($this->_listeners[$name]))
            return array();
        return $this->_listeners[$name];
    }
    public function notify(yEvent $event){
        $args = func_get_args();
        foreach ($this->getListeners($event->getName()) as $listener){
            call_user_func_array($listener, $args);
        }
        return $event;
    }
    public function notifyUntil(yEvent $event){
        $args = func_get_args();
        foreach ($this->getListeners($event->getName()) as $listener){
            if (call_user_func_array($listener, $args)){
                $event->setProcessed(true);
                break;
            }
        }
        return $event;
    }
    public function offsetExists($name){
        return $this->hasListeners($name);
    }
    public function offsetSet($name, $value){
        $this->attach($name, $value);
    }
    public function offsetUnset($name){
        unset($this->_listeners[$name]); // detach all
    }
    public function offsetGet($name){
        return $this->getListeners($name);
    }
}

