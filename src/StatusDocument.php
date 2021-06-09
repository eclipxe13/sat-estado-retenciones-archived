<?php

declare(strict_types=1);

namespace PhpCfdi\SatEstadoRetenciones;

use Eclipxe\Enum\Enum;

/**
 * @method static self active()
 * @method static self cancelled()
 * @method static self notFound()
 * @method bool isActive()
 * @method bool isCancelled()
 * @method bool isNotFound()
 */
class StatusDocument extends Enum
{
}
