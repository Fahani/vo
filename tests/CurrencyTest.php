<?php

namespace StraTDeS\VO\Tests;

use StraTDeS\VO\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            ['EUR', true, 978, 2],
            ['USD', true, 840, 2],
            ['BHD', true, 48, 3],
            ['BIF', true, 108, 0],
            ['BMD', true, 60, 2],
            ['BND', true, 96, 2],
            ['AAA', false, null, null],
            ['BBB', false, null, null],
            ['CCC', false, null, null],
            ['DDD', false, null, null],
        ];
    }

    /**
     * @param string $currency
     * @param bool $isValid
     * @param int|null $iso
     * @param int|null $decimals
     * @dataProvider dataProvider
     */
    public function testGivenACurrencyItIsValidAndHaveAValidConfigOrIsInvalidAndThrowsException(
        string $currency, bool $isValid, ?int $iso, ?int $decimals
    ): void
    {
        if(!$isValid) {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage("$currency is not an allowed currency");
        }

        $currency = Currency::fromValue($currency);

        $this->assertEquals($iso, $currency->config()->iso());
        $this->assertEquals($decimals, $currency->config()->decimals());
    }
}
