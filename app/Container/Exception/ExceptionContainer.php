<?php declare(strict_types=1);

namespace App\Container\Exception;

use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class NotFoundException
 * @package App\Container\Exception
 * @author BENSAAD Mohammed
 */

class ExceptionContainer extends Exception implements ContainerExceptionInterface
{
}
