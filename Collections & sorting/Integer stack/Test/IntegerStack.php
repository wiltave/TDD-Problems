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
 */

require_once realpath(dirname(__FILE__) . '/../Integer/Stack.php');

class Test_IntegerStack extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->_integerStack = new Integer_Stack();
    }

    public function testShouldPushAValuePopItAndReturnOne()
    {
        $this->_integerStack->push(1);
        $this->assertEquals($this->_integerStack->pop(), 1);
    }

    public function testShouldPopEmptyStackAndReturnNull()
    {
        $this->assertEquals($this->_integerStack->pop(), null);
    }

    public function testShouldPushAValuePopItAndReturnTwo()
    {
        $this->_integerStack->push(2);
        $this->assertEquals($this->_integerStack->pop(), 2);
    }

    public function testShouldPushTwoValuesPopOnceAndReturnTheLastOne()
    {
        $this->_integerStack->push(1);
        $this->_integerStack->push(2);
        $this->assertEquals($this->_integerStack->pop(), 2);
    }

    public function testShouldPushTwoValuesPopTwiceAndReturnTheFirstOne()
    {
        $this->_integerStack->push(1);
        $this->_integerStack->push(2);
        $this->_integerStack->pop();
        $this->assertEquals($this->_integerStack->pop(), 1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldPushAStringValueAndThrowAnException()
    {
        $this->_integerStack->push('string');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldPushAnArrayValueAndThrowAnException()
    {
        $this->_integerStack->push(array());
    }

    public function testShouldCountAnEmptyStackAndReturnZero()
    {
        $this->assertEquals($this->_integerStack->count(), 0);
    }

    public function testShouldCountAStackWithOneItemAndReturnOne()
    {
        $this->_integerStack->push(1);
        $this->assertEquals($this->_integerStack->count(), 1);
    }

    public function testShouldCountAStackWithTwoItemsAndReturnTwo()
    {
        $this->_integerStack->push(1);
        $this->_integerStack->push(2);
        $this->assertEquals($this->_integerStack->count(), 2);
    }

    public function testShouldPushTwoItemsPopOnceAndReturnOne()
    {
        $this->_integerStack->push(1);
        $this->_integerStack->push(2);

        $this->_integerStack->pop();

        $this->assertEquals($this->_integerStack->count(), 1);
    }
}
