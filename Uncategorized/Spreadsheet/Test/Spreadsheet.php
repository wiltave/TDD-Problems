<?php
/**
 * Spreadsheet
 * https://sites.google.com/site/tddproblems/all-problems-1/Spreadsheet
 *
 * Bill Wake's Test-First Challenge (Jan. 2002) is an early public TDD problem.
 * Notice that it predates the change in nomenclature from
 * Test First to Test Driven. This challenge also appeared on the
 * Extreme Programming Yahoogroup where it was discussed by many participants.
 */

require_once realpath(dirname(__FILE__) . '/../Sheet/Sheet.php');

class Test_Spreadsheet extends PHPUnit_Framework_TestCase
{
    public function testThatCellsAreEmptyByDefault()
    {
        $sheet = new Sheet();
        $this->assertEquals('', $sheet->get('A1'));
        $this->assertEquals('', $sheet->get('ZX347'));
    }

    public function testThatTextCellsAreStored()
    {
        $sheet = new Sheet();
        $theCell = 'A21';

        $sheet->put($theCell, 'A string');
        $this->assertEquals('A string', $sheet->get($theCell));

        $sheet->put($theCell, 'A different string');
        $this->assertEquals('A different string', $sheet->get($theCell));

        $sheet->put($theCell, '');
        $this->assertEquals('', $sheet->get($theCell));
    }

    public function testThatManyCellsExist()
    {
        $sheet = new Sheet();
        $sheet->put('A1', 'First');
        $sheet->put('X27', 'Second');
        $sheet->put('ZX901', 'Third');

        $this->assertEquals($sheet->get('A1'), 'First', 'A1');
        $this->assertEquals($sheet->get('X27'), 'Second', 'X27');
        $this->assertEquals($sheet->get('ZX901'), 'Third', 'ZX901');

        $sheet->put('A1', 'Fourth');
        $this->assertEquals($sheet->get('A1'), 'Fourth', 'A1 after');
        $this->assertEquals($sheet->get('X27'), 'Second', 'X27 same');
        $this->assertEquals($sheet->get('ZX901'), 'Third', 'ZX901 same');
    }

    // Implement each test before going to the next one.
    // You can split this test case if it helps.
    public function testThatNumericCellsAreIdentifiedAndStored()
    {
        $sheet = new Sheet();
        $theCell = 'A21';

        $sheet->put($theCell, 'X99'); // "Obvious" string
        $this->assertEquals('X99', $sheet->get($theCell));

        $sheet->put($theCell, '14'); // "Obvious" number
        $this->assertEquals('14', $sheet->get($theCell));

        $sheet->put($theCell, ' 99 X'); // Whole string must be numeric
        $this->assertEquals(' 99 X', $sheet->get($theCell));

        $sheet->put($theCell, ' 1234 '); // Blanks ignored
        $this->assertEquals('1234', $sheet->get($theCell));

        $sheet->put($theCell, ' '); // Just a blank
        $this->assertEquals(' ', $sheet->get($theCell));
    }

    public function testThatWeHaveAccessToCellLiteralValuesForEditing()
    {
        $sheet = new Sheet();
        $theCell = 'A21';

        $sheet->put($theCell, 'Some string');
        $this->assertEquals('Some string', $sheet->getLiteral($theCell));

        $sheet->put($theCell, ' 1234 ');
        $this->assertEquals(' 1234 ', $sheet->getLiteral($theCell));

        $sheet->put($theCell, '=7');
        $this->assertEquals('=7', $sheet->getLiteral($theCell));
    }
}
