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
 * yModelCollection
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yModelCollection{
    private $_modelClass = null;
    public function __construct($modelClass){
        $this->_modelClass = $modelClass;
    }
    public function getClass(){
        return $this->_modelClass;
    }
    public function __get($name){
        return new yModelField($this->_modelClass, $name);
    }
    /* public function __set($name, $value){
      // set default value
      } */
}

