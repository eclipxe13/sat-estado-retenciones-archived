<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Features;

use PhpCfdi\SatEstadoRetenciones\Parameters;
use PhpCfdi\SatEstadoRetenciones\Scraper;
use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;

class ObtainStatusWithRealCfdiTest extends TestCase
{
    public function testObtainStatusWithRealCfdiFile(): void
    {
        $parameters = new Parameters(
            '48C4CE37-E218-4AAE-97BE-20634A36C628', // UUID
            'DCM991109KR2', // RFC Emisor
            'SAZD861013FU2', // RFC Receptor
        );

        $scraper = new Scraper();
        $result = $scraper->obtainStatus($parameters);

        $this->assertTrue($result->getStatusDocument()->isActive());
        $this->assertSame($parameters->getIssuerRfc(), $result->getIssuerRfc());
        $this->assertSame($parameters->getReceiverRfc(), $result->getReceiverRfc());
        $this->assertSame($parameters->getUuid(), $result->getUuid());
    }
}
