<?php
/**
 * Integer stack
 * https://sites.google.com/site/tddproblems/all-problems-1/Integer-stack
 *
 * Develop a class implementing the classic Stack datastructure containing
 * integer values. That is, it should support the following operations:
 *
 *    Push(value) - adds a value to top of the stack
 *    value Pop() - removes the top element of the stack and returns that value
 *    int Count() - returns the current number of elements contained
 *    in the stack
 *
 * @package Collections & sorting
 * @subpackage Integer stack
 * @version 0.1
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 * @author Willian Gustavo Veiga <wiltave@gmail.com>
 */
class Integer_Stack
{
    private $_stack;

    public function __construct()
    {
        $this->_stack = array();
    }

    /**
     * Adds a value to top of the stack
     * @param int $value
     */
    public function push($value)
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException('Value must be an integer.');
        }

        $this->_stack[] = $value;
    }

    /**
     * Removes the top element of the stack and returns that value
     * @return int
     */
    public function pop()
    {
        return array_pop($this->_stack);
    }

    /**
     * Returns the current number of elements contained in the stack
     * @return int
     */
    public function count()
    {
        return count($this->_stack);
    }
}
