<?php
/**
 * Spreadsheet
 * https://sites.google.com/site/tddproblems/all-problems-1/Spreadsheet
 *
 * Bill Wake's Test-First Challenge (Jan. 2002) is an early public TDD problem.
 * Notice that it predates the change in nomenclature from
 * Test First to Test Driven. This challenge also appeared on the
 * Extreme Programming Yahoogroup where it was discussed by many participants.
 *
 * @package Uncategorized
 * @subpackage Spreadsheet
 * @version 0.1
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 * @author Willian Gustavo Veiga <wiltave@gmail.com>
 */
class Sheet
{
    private $_data;
    private $_literal;

    public function put($cell, $value)
    {
        $this->_literal[$cell] = $value;
        if (preg_match('~^\s*\d+\s*$~', $value)) {
            $this->_data[$cell] = trim($value);
            return;
        }
        $this->_data[$cell] = $value;
    }

    public function get($cell)
    {
        return $this->_data[$cell];
    }

    public function getLiteral($cell)
    {
        return $this->_literal[$cell];
    }
}
