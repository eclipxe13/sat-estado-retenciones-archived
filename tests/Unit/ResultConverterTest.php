<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Tests\Unit;

use PhpCfdi\SatEstadoRetenciones\ResultConverter;
use PhpCfdi\SatEstadoRetenciones\Tests\TestCase;

final class ResultConverterTest extends TestCase
{
    public function testWellKnownConvertHtml(): void
    {
        // The file _files/result-html.html was obtained directly from SAT at 2021-06-08

        $html = $this->fileContents('result-html.html');

        $converter = new ResultConverter();
        $result = $converter->convertHtml($html);

        $this->assertSame('DCM991109KR2', $result->getIssuerRfc());
        $this->assertSame('DEREMATE.COM DE MEXICO S DE RL DE CV', $result->getIssuerName());
        $this->assertSame('SAZD861013FU2', $result->getReceiverRfc());
        $this->assertSame('DANIEL SANCHEZ', $result->getReceiverName());
        $this->assertSame('48C4CE37-E218-4AAE-97BE-20634A36C628', $result->getUuid());
        $this->assertSame('2021-02-05T22:44:48', $result->getExpedition());
        $this->assertSame('2021-02-05T17:36:46', $result->getCertification());
        $this->assertSame('TLE011122SC2', $result->getPacRfc());
        $this->assertSame('$431.03', $result->getTotal());
        $this->assertSame('Vigente', $result->getState());
    }

    public function testCreateStatusDocumentFromValueActive(): void
    {
        $converter = new ResultConverter();
        $this->assertTrue($converter->createStatusDocumentFromValue('Vigente')->isActive());
    }

    public function testCreateStatusDocumentFromValueCancelled(): void
    {
        $converter = new ResultConverter();
        $this->assertTrue($converter->createStatusDocumentFromValue('Cancelado')->isCancelled());
    }

    /**
     * @param string $value
     * @testWith [""]
     *           ["Otro valor"]
     *           ["vigente"]
     */
    public function testCreateStatusDocumentFromValueNotFound(string $value): void
    {
        $converter = new ResultConverter();
        $this->assertTrue($converter->createStatusDocumentFromValue($value)->isNotFound());
    }
}
