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
 * yModelOrder
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yModelOrder{
    private $_field = null;
    private $_direction = null;
    public function __construct($field, $direction = 'asc'){
        $this->_field = $field;
        $this->_direction = $direction;
    }
    public function getField(){
        return $this->_field;
    }
    public function getDirection(){
        return $this->_direction;
    }
    public function setDirection($direction){
        $this->_direction = $direction;
    }
    public function setField($field){
        $this->_field = $field;
    }
}

