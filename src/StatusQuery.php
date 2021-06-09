<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

use Eclipxe\Enum\Enum;
use JsonSerializable;

/**
 * @method static self found()
 * @method static self notFound()
 * @method bool isFound()
 * @method bool isNotFound()
 */
final class StatusQuery extends Enum implements JsonSerializable
{
    public function jsonSerialize(): string
    {
        return $this->value();
    }
}
