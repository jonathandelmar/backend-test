<?php

namespace FinderTests;

class HelpersTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;
    public function setUp()
    {
        $this->helper = new \Finder\Helpers();
    }

    public function testSingleMonth()
    {
        $this->assertEquals("1 month", $this->helper->months(1));
    }

    public function testMultipleMonth()
    {
        $this->assertEquals("5 months", $this->helper->months(5));
    }

    public function testInvalidMonths()
    {
        $this->assertEquals("", $this->helper->months('abds'));
    }

    public function testYesNoInvalid()
    {
        $this->assertEquals("", $this->helper->yesNo('hasd'));
    }

    public function testYesNoYes()
    {
        $this->assertEquals("Yes", $this->helper->yesNo(1));
        $this->assertEquals("Yes", $this->helper->yesNo("yes"));
    }

    public function testYesNoNo()
    {
        $this->assertEquals("No", $this->helper->yesNo(0));
        $this->assertEquals("No", $this->helper->yesNo("no"));
    }

    public function testMoneyNoDecimals()
    {
        $this->assertEquals("$10", $this->helper->money(10));
    }

    public function testMoneyDecimals()
    {
        $this->assertEquals("$10.50", $this->helper->money(10.5));
    }

    public function testMoneyRounding()
    {
        $this->assertEquals("$10.51", $this->helper->money(10.5193, 2));
    }

    public function testDateOnlyDateNoFormat()
    {
        $this->assertEquals("2015-04-29 00:00:00", $this->helper->date('2015-04-29'));
    }

    public function testDateDateFormat()
    {
        $this->assertEquals("29 04 2015", $this->helper->date('2015-04-29', 'd m Y'));
    }

    public function testDateDateTimeFormat()
    {
        $this->assertEquals("14:02 29 04 2015", $this->helper->date('2015-04-29 14:02:31', 'H:i d m Y'));
    }

    public function testDateWithTimezone()
    {
        $this->assertEquals("14:02 29 04 2015", $this->helper->date('2015-04-29 14:02:31', 'H:i d m Y', 'Asia/Manila'));
    }

    public function testCurrencyFormatterUSD()
    {
        $this->assertEquals("$50.00", $this->helper->currency(50, 'USD'));
    }

    public function testCurrencyFormatterEUR()
    {
        $this->assertEquals("€50.00", $this->helper->currency(50, 'EUR'));
    }

    public function testCurrencyFormatterGBP()
    {
        $this->assertEquals("£50.00", $this->helper->currency(50, 'GBP'));
    }

    public function testCurrencyFormatterRounding()
    {
        $this->assertEquals("$50.64", $this->helper->currency(50.638, 'USD'));
    }

    public function testCurrencyFormatterFormat()
    {
        $this->assertEquals("$50,250.00", $this->helper->currency(50250, 'USD'));
    }

    public function testListOneElement()
    {
        $this->assertEquals("orange", $this->helper->stringList(['orange']));
    }

    public function testListTwoElements()
    {
        $this->assertEquals("orange and green", $this->helper->stringList(['orange', 'green']));
    }

    public function testListSeveralElements()
    {
        $this->assertEquals("orange, red, yellow and green", $this->helper->stringList(['orange', 'red', 'yellow', 'green']));
    }

    public function testPluralizeInvalid()
    {
        $this->assertEquals( 'not a number', $this->helper->pluralize( 'not a number', 'bag' ) );
    }

    public function testPluralizeSingleItem()
    {
        $this->assertEquals( '1 bag', $this->helper->pluralize( 1, 'bag' ));
    }

    public function testPluralizeMultipleItems()
    {
        $this->assertEquals( '5 bags', $this->helper->pluralize( 5, 'bag' ));
    }
}
