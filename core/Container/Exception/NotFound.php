<?php declare(strict_types=1);

namespace App\Container\Exception;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class NotFoundException
 * @package App\Container\Exception
 * @author BENSAAD Mohammed
 */
class NotFound extends Exception implements NotFoundExceptionInterface
{
}
