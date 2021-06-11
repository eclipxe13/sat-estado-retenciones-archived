<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

use PhpCfdi\SatEstadoRetenciones\Internal\ResultConverter;
use Symfony\Component\DomCrawler\Crawler;

class Scraper
{
    public const SAT_WEBAPP_URL = 'https://prodretencionverificacion.clouda.sat.gob.mx/Home/ConsultaRetencion';

    private HttpClientInterface $httpClient;

    private ResultConverter $resultConverter;

    public function __construct(HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?? new PhpStreamContextHttpClient();
        $this->resultConverter = new ResultConverter();
    }

    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }

    /**
     * Consumes the web page to obtain the information about a document CFDI Retentions
     *
     * @param Parameters $parameters
     * @return Result
     * @throws Exceptions\RetentionNotFoundException when unable retention document was not found
     * @throws Exceptions\HttpClientException when unable to retrieve contents
     */
    public function obtainStatus(Parameters $parameters): Result
    {
        $url = $this->makeUrl($parameters);
        $html = $this->httpClient->getContents($url);
        $crawler = new Crawler($html, $url);
        if ($this->responseIsNotFound($crawler)) {
            throw new Exceptions\RetentionNotFoundException($parameters);
        }
        return $this->resultConverter->convertCrawler($crawler);
    }

    public function responseIsNotFound(Crawler $crawler): bool
    {
        return ($crawler->filter('.noresultados')->count() > 0);
    }

    public function makeUrl(Parameters $parameters): string
    {
        return self::SAT_WEBAPP_URL . '?' . http_build_query([
            'folio' => $parameters->getUuid(),
            'rfcEmisor' => $parameters->getIssuerRfc(),
            'rfcReceptor' => $parameters->getReceiverRfc(),
            '_' => $this->obtainMillisecondsParameter(),
        ]);
    }

    public function obtainMillisecondsParameter(float $microtime = null): int
    {
        $microtime = $microtime ?? microtime(true);
        return intval($microtime * 1000);
    }
}
