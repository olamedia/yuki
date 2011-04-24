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
 * yCommentNode
 *
 * @package yuki
 * @subpackage html
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yJsCommentNode{
    protected $_value = '';
    public function __construct($text = ''){
        $this->_value = $text;
    }
    public function getValue(){
        return $this->_value;
    }
    public function __toString(){
        return "\r\n".'//<!--'."\r\n".
        ($this->_value)."\r\n".
        '//-->'."\r\n";
    }
}

