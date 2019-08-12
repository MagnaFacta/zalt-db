<?php

/**
 *
 * @package    Zalt
 * @subpackage Db
 * @author     Matijs de Jong <mjong@magnafacta.nl>
 * @copyright  Copyright (c) 2016, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 */

namespace Zalt\Db;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\ResultSet\ResultSetInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Adapter\Driver\StatementInterface;

/**
 *
 * @package    Zalt
 * @subpackage Db
 * @copyright  Copyright (c) 2016, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 * @since      Class available since version 1.8.1 Oct 22, 2016 8:14:50 PM
 */
class DbBridge implements AdapterInterface
{
    /**
     *
     * @var Adapter
     */
    protected $dbAdapter;

    /**
     *
     * @param Adapter $db
     */
    public function __construct(Adapter $db)
    {
        $this->dbAdapter = $db;
    }

    /**
     *
     * @param string|TableIdentifier|array                                              $table
     * @param Feature\AbstractFeature|Feature\FeatureSet|Feature\AbstractFeature[]|null $features
     * @param ResultSetInterface|null                                                   $resultSetPrototype
     * @param Sql|null                                                                  $sql
     *
     * @throws Exception\InvalidArgumentException
     * @return Zalt\Db\TableGateway\TableGateway
     */
    public function createTableGateway($table, $features = null, ResultSetInterface $resultSetPrototype = null, Sql $sql = null)
    {
        return new TableGateway\TableGateway($table, $this, $features, $resultSetPrototype, $sql);
    }

    /**
     * query() is a convenience function
     *
     * @param string $sql
     * @param string|array|ParameterContainer $parametersOrQueryMode
     * @param \Zend\Db\ResultSet\ResultSetInterface $resultPrototype
     * @throws Exception\InvalidArgumentException
     * @return int Number of affected rows
     */
    public function execute($sql, $parametersOrQueryMode = Adapter::QUERY_MODE_PREPARE, ResultSetInterface $resultPrototype = null)
    {
        $stmt = $this->dbAdapter->query($sql, $parametersOrQueryMode, $resultPrototype);

        if ($stmt instanceof StatementInterface) {
            $result = $stmt->execute();
        }  else {
            $result = $stmt;
        }

        if ($result instanceof ResultInterface) {
            return $result->getAffectedRows();
        }
    }

    /**
     * @return Adapter
     */
    public function getAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * @return \Zend\Db\Driver\DriverInterface
     */
    public function getDriver()
    {
        return $this->dbAdapter->getDriver();
    }

    /**
     * @return \Zend\Db\Platform\PlatformInterface
     */
    public function getPlatform()
    {
        return $this->dbAdapter->getPlatform();
    }
}
