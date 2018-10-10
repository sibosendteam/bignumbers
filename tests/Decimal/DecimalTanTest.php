<?php

use Sibosend\BigNumbers\Decimal as Decimal;
use Sibosend\BigNumbers\DecimalConstants as DecimalConstants;
use PHPUnit\Framework\TestCase;

/**
 * @group tan
 */
class DecimalTanTest extends TestCase
{
    public function tanProvider() {
        // Some values providede by mathematica
        return [
            ['1', '1.55740772465490', 14],
            ['123.123', '0.68543903342472368', 17],
            ['15000000000', '-0.95779983511717825557', 20]
        ];
    }

    /**
     * @dataProvider tanProvider
     */
    public function testSimple($nr, $answer, $digits)
    {
        $x = Decimal::create($nr);
        $tanX = $x->tan($digits);
        $this->assertTrue(
            Decimal::create($answer)->equals($tanX),
            'tan('.$nr.') must be equal to '.$answer.', but was '.$tanX
        );
    }

    /**
     * @expectedException \DomainException
     * @expectedExceptionMessage The tangent of this 'angle' is undefined.
     */
    public function testTanPiTwoDiv()
    {
        $PiDividedByTwo = DecimalConstants::PI()->div(Decimal::create(2));
        $PiDividedByTwo->tan();
    }

}