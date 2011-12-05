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
 * yModelExpression
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yModelExpression{
    private $_left = null;
    private $_operator = null;
    private $_right = null;
    public function __construct($left = null, $operator = null, $right = null){
        $this->_left = $left;
        $this->_operator = $operator;
        $this->_right = $right;
    }
    public function getLeft(){
        return $this->_left;
    }
    public function setLeft($left){
        $this->_left = $left;
    }
    public function getRight(){
        return $this->_right;
    }
    public function setRight($right){
        $this->_right = $right;
    }
    public function getOperator(){
        return $this->_operator;
    }
    public function setOperator($operator){
        $this->_operator = $operator;
    }
}

