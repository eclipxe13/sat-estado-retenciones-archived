<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones\Internal;

use PhpCfdi\SatEstadoRetenciones\Result;
use PhpCfdi\SatEstadoRetenciones\ValueObjects\StatusDocument;
use Symfony\Component\DomCrawler\Crawler;

/** @internal */
class ResultConverter
{
    public function convertHtml(string $html): Result
    {
        $crawler = new Crawler($html);
        return $this->convertCrawler($crawler);
    }

    public function convertCrawler(Crawler $crawler): Result
    {
        $labels = $crawler->filter('#tbl_resultado th')->each(
            function (Crawler $th): string {
                return $th->text();
            }
        );
        $values = $crawler->filter('#tbl_resultado td')->each(
            function (Crawler $td): string {
                return $td->text();
            }
        );

        $dataValues = array_combine($labels, $values) ?: [];
        $dataValues['EFOS'] = (string) $crawler->filter('#efosEstatus')->attr('value');

        return new Result(
            $dataValues['RFC del Emisor'],
            $dataValues['Nombre o Razón Social del Emisor'],
            $dataValues['RFC del Receptor'],
            $dataValues['Nombre o Razón Social del Receptor'],
            $dataValues['Folio Fiscal'],
            $dataValues['Fecha de Expedición'],
            $dataValues['Fecha Certificación SAT'],
            $dataValues['PAC que Certificó'],
            $dataValues['Total del CFDI Retención'],
            $dataValues['Estado CFDI Retención'],
            $dataValues['EFOS'],
        );
    }

    public function createStatusDocumentFromValue(string $value): StatusDocument
    {
        if ('Vigente' === $value) {
            return StatusDocument::active();
        }
        if ('Cancelado' === $value) {
            return StatusDocument::cancelled();
        }
        return StatusDocument::unknown();
    }
}
