<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Features;

use PhpCfdi\SatEstadoRetenciones\Exceptions\RetentionNotFoundException;
use PhpCfdi\SatEstadoRetenciones\Parameters;
use PhpCfdi\SatEstadoRetenciones\Scraper;
use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;

class ObtainStatusWithNonExistentCfdiTest extends TestCase
{
    public function testObtainStatusWithNonExistentCfdi(): void
    {
        $parameters = new Parameters(
            '12345678-1234-1234-1234-123456789012', // UUID
            'COSC8001137NA', // RFC Emisor
            'SAZD861013FU2', // RFC Receptor
        );

        $scraper = new Scraper();
        $this->expectException(RetentionNotFoundException::class);
        $scraper->obtainStatus($parameters);
    }
}
