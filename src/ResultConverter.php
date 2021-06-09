<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

use Symfony\Component\DomCrawler\Crawler;

class ResultConverter
{
    public function convertHtml(string $html): RetentionResult
    {
        $crawler = new Crawler($html);
        return $this->convertCrawler($crawler);
    }

    public function convertCrawler(Crawler $crawler): RetentionResult
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

        $dataValues = array_combine($labels, $values);
        $dataValues['EFOS'] = $crawler->filter('#efosEstatus')->attr('value');

        return new RetentionResult(
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
