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

namespace yuki;

require_once 'internalBootstrap.php';
\yCoreAutoloader::getInstance()->rebuild();

require_once dirname(__FILE__).'/../nsrc/autoload/autoloader.php';
require_once dirname(__FILE__).'/../nsrc/autoload/coreAutoloader.php';
\yuki\coreAutoloader::getInstance()->rebuild();

