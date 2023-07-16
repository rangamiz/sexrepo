<?php

namespace App\DB;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;

class ConnectUsTableGateway extends TableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct('ConnectUs', $adapter);
    }
}