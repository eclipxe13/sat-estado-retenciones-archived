<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Unit;

use JsonSerializable;
use PhpCfdi\SatEstadoRetenciones\Parameters;
use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;

class RetentionQueryTest extends TestCase
{
    public function testJsonSerialize(): void
    {
        $parameters = new Parameters('12345678-1234-1234-1234-123456789012', 'AAA010101AAA', 'XXXX991231XX0');

        $this->assertInstanceOf(JsonSerializable::class, $parameters);
        $this->assertJsonStringEqualsJsonFile($this->filePath('query.json'), json_encode($parameters) ?: '');
    }
}
