<?php

namespace Leaphly\Price;

use Leaphly\Price\Price;

class ConversionPriceTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $price = new Price(
            [
                'EUR' => 5,
                'USD' => 10,
                'GBP' => 15,
            ],
            ['USD/CHF 1.500']
        );

        $this->assertInstanceOf(
            'Leaphly\Price\Price',
            $price
        );

        $this->assertEquals(15,
            $price->getAmount('CHF')
        );
    }

    public function testShouldAlsoHaveCHFInTheAvailableCurrencies()
    {
        $price = new Price(
            [
                'EUR' => 5,
                'USD' => 10,
                'GBP' => 15,
            ],
            ['USD/CHF 1.500']
        );

        $this->assertEquals('EUR-USD-GBP-CHF',
            join('-',$price->availableCurrencies())
        );
    }

    public function testConversionRecursive()
    {
        $price = new Price(
            [
                'EUR' => 1
            ],
            [   'EUR/USD 2',
                'USD/CHF 2'
            ]

        );

        $this->assertInstanceOf(
            'Leaphly\Price\Price',
            $price
        );

        $this->assertEquals(4,
            $price->getAmount('CHF')
        );
    }
}