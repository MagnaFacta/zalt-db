<?php

/**
 *
 * @package    Zalt
 * @subpackage Db\Sql\Literal
 * @author     Matijs de Jong <mjong@magnafacta.nl>
 * @copyright  Copyright (c) 2016, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 */

namespace Zalt\Db\Sql\Literal;

use Laminas\Db\Sql\Literal;

/**
 *
 * @package    Zalt
 * @subpackage Db\Sql\Literal
 * @copyright  Copyright (c) 2016, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 * @since      Class available since version 1.8.1 Oct 22, 2016 8:47:49 PM
 */
class CurrentTimestampLiteral extends Literal
{
    /**
     * @param string $literal
     */
    public function __construct($literal = 'CURRENT_TIMESTAMP')
    {
        parent::__construct($literal);
    }
}
