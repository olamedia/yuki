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
 * yPam
 * Pluggable Authentication Modules
 *
 * @package yuki
 * @subpackage pam
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yPam{
    protected $_rules = array();
    public function add($yPamRule){
        $this->_rules[] = $yPamRule;
    }
}

$pam = yServiceLocator::get('pam');
$pam->add()