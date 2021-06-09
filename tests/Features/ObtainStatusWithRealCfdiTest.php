<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Features;

use PhpCfdi\SatEstadoRetenciones\RetentionQuery;
use PhpCfdi\SatEstadoRetenciones\Scraper;
use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;

class ObtainStatusWithRealCfdiTest extends TestCase
{
    public function testObtainStatusWithRealCfdiFile(): void
    {
        $query = new RetentionQuery(
            '48C4CE37-E218-4AAE-97BE-20634A36C628', // UUID
            'DCM991109KR2', // RFC Emisor
            'SAZD861013FU2', // RFC Receptor
        );

        $scraper = new Scraper();
        $result = $scraper->obtainStatus($query);

        $this->assertTrue($result->getDocument()->isActive());
        $this->assertSame($query->getIssuerRfc(), $result->getIssuerRfc());
        $this->assertSame($query->getReceiverRfc(), $result->getReceiverRfc());
        $this->assertSame($query->getUuid(), $result->getUuid());
    }
}
