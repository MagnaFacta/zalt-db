<?php

/**
 *
 * @package    Zalt
 * @subpackage Db\TableGateway
 * @author     Matijs de Jong <mjong@magnafacta.nl>
 * @copyright  Copyright (c) 2016, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 */

namespace Zalt\Db\TableGateway;

use Laminas\Db\TableGateway\TableGateway as LaminasTableGateway;

/**
 *
 * @package    Zalt
 * @subpackage Db\TableGateway
 * @copyright  Copyright (c) 2016, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 * @since      Class available since version 1.8.1 Oct 22, 2016 8:21:43 PM
 */
class TableGateway extends LaminasTableGateway
{
    public function fetchRow($where = null, $order = null)
    {
        if (!$this->isInitialized) {
            $this->initialize();
        }

        $select = $this->sql->select();

        if ($where instanceof \Closure) {
            $where($select);
        } elseif ($where !== null) {
            $select->where($where);
        }
        if ($order) {
            $select->order($order);
        }
        $select->limit(1);

        $resultSet = $this->executeSelect($select);
        $resultRow = $resultSet->current();
        unset($resultSet);

        return $resultRow;
    }
}
