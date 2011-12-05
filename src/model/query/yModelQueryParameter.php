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
 * yModelQueryParameter
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yModelQueryParameter{
    private $_name = null;
    public function __construct($name = null){
        $this->_name = $name;
    }
    public function getName(){
        return $this->_name;
    }
    public function __toString(){
        return ($this->_name === null)?'':$this->_name;
    }
}

