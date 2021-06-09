<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Unit;

use PhpCfdi\SatEstadoRetenciones\RetentionQuery;
use PhpCfdi\SatEstadoRetenciones\Scraper;
use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;

final class ScraperTest extends TestCase
{
    public function testMakeUrlHasValuesOnQueryString(): void
    {
        $query = new RetentionQuery('12345678-1234-1234-1234-123456789012', 'AAA010101AAA', 'XXXX991231XX0');
        $scraper = new Scraper();
        $url = $scraper->makeUrl($query);
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $queryValues);

        $expectedValues = array_filter([
            'folio' => '12345678-1234-1234-1234-123456789012',
            'rfcEmisor' => 'AAA010101AAA',
            'rfcReceptor' => 'XXXX991231XX0',
            '_' => $queryValues['_'] ?? null
        ]);

        $this->assertSame($expectedValues, $queryValues);
        $this->assertTrue(is_numeric($queryValues['_'] ?? null), 'url does not contains "_" on query string');
    }

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
