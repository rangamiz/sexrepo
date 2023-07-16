<?php

namespace App\DB;

use Psr\Container\ContainerInterface;

class ConnectUsTableGatewayFactory
{
    public function __invoke(ContainerInterface $container): ConnectUsTableGateway
    {
        return new ConnectUsTableGateway(
            $container->get(DBAdapter::class)
        );
    }
}