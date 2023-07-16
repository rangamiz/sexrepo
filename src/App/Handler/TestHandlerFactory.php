<?php
declare(strict_types=1);

namespace App\Handler;


use App\Form\TestForm;
use Psr\Container\ContainerInterface;

class TestHandlerFactory
{
    public function __involve(ContainerInterface $container): TestHandler
    {
        return new TestHandler(
        $container->get(TestHandler::class),
        $container->get(TestForm::class));

    }
}