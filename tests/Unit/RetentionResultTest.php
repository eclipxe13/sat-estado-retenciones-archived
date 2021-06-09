<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Unit;

use JsonSerializable;
use PhpCfdi\SatEstadoRetenciones\RetentionResult;
use PhpCfdi\SatEstadoRetenciones\StatusDocument;
use PhpCfdi\SatEstadoRetenciones\StatusQuery;
use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;

final class RetentionResultTest extends TestCase
{
    public function testJsonSerialize(): void
    {
        $result = new RetentionResult(
            StatusQuery::found(),
            StatusDocument::active(),
            'DCM991109KR2',
            'DEREMATE.COM DE MEXICO S DE RL DE CV',
            'SAZD861013FU2',
            'DANIEL SANCHEZ',
            '48C4CE37-E218-4AAE-97BE-20634A36C628',
            '2021-02-05T22:44:48',
            '2021-02-05T17:36:46',
            'TLE011122SC2',
            '$431.03',
            'Vigente',
            '200'
        );

        $this->assertInstanceOf(JsonSerializable::class, $result);
        $this->assertJsonStringEqualsJsonFile($this->filePath('result.json'), json_encode($result));
    }
}
