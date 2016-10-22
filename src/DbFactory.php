<?php

/**
 *
 * @package    Zalt
 * @subpackage Db
 * @author     Matijs de Jong <mjong@magnafacta.nl>
 * @copyright  Copyright (c) 2016, MagnaFacta B.V.
 * @license    New BSD License
 */

namespace Zalt\Db;

use Zend\Db\Adapter\Adapter;

/**
 *
 * @package    Zalt
 * @subpackage Db
 * @copyright  Copyright (c) 2016, MagnaFacta B.V.
 * @license    New BSD License
 * @since      Class available since version 1.8.1 Oct 21, 2016 3:29:19 PM
 */
class DbFactory
{
    public static function creatorForServiceManager($dbConfig, $testConnection = true) {
        if ($testConnection) {
            return function() use ($dbConfig) {
                $db = new Adapter($dbConfig);

                $db->getDriver()->getConnection()->connect();

                return new DbBridge($db);
            };
        }
        return function() use ($dbConfig) {
            return new DbBridge(new Adapter($dbConfig));
        };
    }
}
