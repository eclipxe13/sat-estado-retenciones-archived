<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

class RetentionResult
{
    private StatusQuery $query;

    private StatusDocument $document;

    private string $issuerRfc;

    /** @var array<string, string> */
    private array $rawValues;

    private string $issuerName;

    private string $receiverRfc;

    private string $receiverName;

    private string $uuid;

    private string $expedition;

    private string $certification;

    private string $pacRfc;

    private string $total;

    private string $state;

    public function __construct(
        StatusQuery $query,
        StatusDocument $document,
        string $issuerRfc,
        string $issuerName,
        string $receiverRfc,
        string $receiverName,
        string $uuid,
        string $expedition,
        string $certification,
        string $pacRfc,
        string $total,
        string $state,
        array $rawValues
    ) {
        $this->query = $query;
        $this->document = $document;
        $this->issuerRfc = $issuerRfc;
        $this->issuerName = $issuerName;
        $this->receiverRfc = $receiverRfc;
        $this->receiverName = $receiverName;
        $this->uuid = $uuid;
        $this->expedition = $expedition;
        $this->certification = $certification;
        $this->pacRfc = $pacRfc;
        $this->total = $total;
        $this->state = $state;
        $this->rawValues = $rawValues;
    }

    public function getQuery(): StatusQuery
    {
        return $this->query;
    }

    public function getDocument(): StatusDocument
    {
        return $this->document;
    }

    public function getIssuerRfc(): string
    {
        return $this->issuerRfc;
    }

    public function getIssuerName(): string
    {
        return $this->issuerName;
    }

    public function getReceiverRfc(): string
    {
        return $this->receiverRfc;
    }

    public function getReceiverName(): string
    {
        return $this->receiverName;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getExpedition(): string
    {
        return $this->expedition;
    }

    public function getCertification(): string
    {
        return $this->certification;
    }

    public function getPacRfc(): string
    {
        return $this->pacRfc;
    }

    public function getTotal(): string
    {
        return $this->total;
    }

    public function getState(): string
    {
        return $this->state;
    }

    /** @return array<string, string> */
    public function getRawValues(): array
    {
        return $this->rawValues;
    }
}
