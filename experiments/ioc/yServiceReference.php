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
 * yServiceReference
 *
 * @package yuki
 * @subpackage ioc
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yServiceReference{
    protected $_serviceName = null;
    public function __construct($serviceName){
        $this->_serviceName = $serviceName;
    }
    public function getService(){
        return yServiceLocator::getInstance()->getService($this->_serviceName);
    }
    public function __toString(){
        return (string) $this->_serviceName;
    }
}

