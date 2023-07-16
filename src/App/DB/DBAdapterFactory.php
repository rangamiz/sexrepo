<?php

namespace App\DB;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;

class DBAdapterFactory
{
public function __invoke(ContainerInterface $container):Adapter
{
    $databaseConfig = $container->get('config')['database'];
    return new Adapter($databaseConfig);

}
}