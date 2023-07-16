<?php
declare(strict_types=1);

namespace App\Handler;


use App\DB\ConnectUsTableGateway;
use App\Form\ConnectUsForm;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ConnectUsHandlerFactory
{
    public function __invoke(ContainerInterface $container): ConnectUsHandler
    {
        return new ConnectUsHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(ConnectUsForm::class),
            $container->get(ConnectUsTableGateway::class));

    }
}