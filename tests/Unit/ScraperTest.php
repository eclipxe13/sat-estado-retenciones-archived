<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Unit;

use PhpCfdi\SatEstadoRetenciones\Scraper;
use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;

final class ScraperTest extends TestCase
{
    public function testObtainMillisecondsParameter(): void
    {
        $microtime = idate('U', strtotime('2021-01-13T14:15:16 -06:00')) + 0.123123;
        $expected = 1610568916123;

        $scraper = new Scraper();
        $this->assertSame($expected, $scraper->obtainMillisecondsParameter($microtime));
        $this->assertGreaterThanOrEqual(
            $scraper->obtainMillisecondsParameter(time()),
            $scraper->obtainMillisecondsParameter()
        );
    }
}
