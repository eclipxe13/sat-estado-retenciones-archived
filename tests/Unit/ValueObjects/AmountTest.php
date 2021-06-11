<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Unit\ValueObjects;

use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;
use PhpCfdi\SatEstadoRetenciones\ValueObjects\Amount;

final class AmountTest extends TestCase
{
    public function testRegularValue(): void
    {
        $expression = ' $ 1,234.56 ';
        $amount = Amount::newFromString($expression);

        $this->assertEqualsWithDelta(1_234.56, $amount->getValue(), 0.001);
        $this->assertSame('1,234.56', $amount->format());
    }
}
