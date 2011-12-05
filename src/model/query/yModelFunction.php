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
 * yModelFunction
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yModelFunction{
    private $_function = null;
    private $_arguments = array();
    public function __construct(){
        if (func_num_args()){
            $this->_arguments = func_get_args();
            $this->_function = array_shift($this->_arguments);
        }
    }
    public function getArguments(){
        return $this->_arguments;
    }
    public function setArguments($arguments){
        $this->_arguments = $arguments;
    }
    public function getFunction(){
        return $this->_function;
    }
    public function setFunction($name){
        $this->_function = $name;
    }
}

