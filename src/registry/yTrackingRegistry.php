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
 * yTrackingRegistry
 *
 * @package yuki
 * @subpackage registry
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yTrackingRegistry extends yRegistry{
    protected $_changed = false;
    protected $_changesMap = array();
    public function set($name, $value = null){
        if (is_object($name)){
            $name = "$name";
        }
        if (array_key_exists($name, $this->_map)){
            if ($this->_map[$name] !== $value){
                $this->_changed = true;
                $this->_changesMap[$name] = true;
            }
        }
        $this->_map[$name] = $value;
    }
    public function markUnchanged(){
        $this->_changed = false;
        $this->_changesMap = array();
    }
    public function getChangesMap(){
        return $this->_changesMap;
    }
    public function getChangedKeys(){
        return array_keys($this->_changesMap);
    }
}

