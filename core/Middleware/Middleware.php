<?php 

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Middleware implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        return $handler->handle($request);
    }
}