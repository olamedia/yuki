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
 * yModelField
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yModelField{
    private $_modelClass = null;
    private $_propertyName = null;
    public function __construct($modelClass, $propertyName){
        $this->_modelClass = $modelClass;
        $this->_propertyName = $propertyName;
    }
    public function getClass(){
        return $this->_modelClass;
    }
    public function getPropertyName(){
        return $this->_propertyName;
    }
    public function is($value){
        return new yModelExpression($this, 'is', $value);
    }
    public function not($value){
        return new yModelExpression($this, 'not', $value);
    }
    public function gt($value){
        return new yModelExpression($this, 'gt', $value);
    }
    public function gte($value){
        return new yModelExpression($this, 'gte', $value);
    }
    public function lt($value){
        return new yModelExpression($this, 'lt', $value);
    }
    public function lte($value){
        return new yModelExpression($this, 'lte', $value);
    }
    public function in($value){
        return new yModelExpression($this, 'in', $value);
    }
    public function notIn($value){
        return new yModelExpression($this, 'notIn', $value);
    }
    public function like($value){
        return new yModelExpression($this, 'like', $value);
    }
    public function sum(){
        return new yModelFunction('sum', $this);
    }
    public function avg(){
        return new yModelFunction('avg', $this);
    }
    public function count(){
        return new yModelFunction('count', $this);
    }
}

