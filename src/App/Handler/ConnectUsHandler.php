<?php
declare(strict_types=1);

namespace App\Handler;

use App\DB\ConnectUsTableGateway;
use App\Form\ConnectUsForm;
use Laminas\Diactoros\Response\TextResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class ConnectUsHandler implements RequestHandlerInterface
{
    private TemplateRendererInterface $templateRenderer;
    private ConnectUsForm $connectUsForm;
    private ConnectUsTableGateway $connectUsTableGateway;

    public function __construct(TemplateRendererInterface $templateRenderer,
                                ConnectUsForm             $connectUsForm,
                                ConnectUsTableGateway     $connectUsTableGateway)
    {
        $this->templateRenderer = $templateRenderer;
        $this->connectUsForm = $connectUsForm;
        $this->connectUsTableGateway = $connectUsTableGateway;

    }

    public function Handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === 'GET') {
            return new HtmlResponse($this->templateRenderer->render('app::connectUs',
                ['ConnectUs' => $this->connectUsForm->getMessages()]));
        }
        $this->connectUsForm->setData($request->getParsedBody());
        $isValid = $this->connectUsForm->IsValid();
        if (!$isValid) {
            return new HtmlResponse($this->templateRenderer->render(
                'app::connectUs',
                ['FormMessages' => $this->connectUsForm->getMessages()]
            ));
        }
        $data = $request->getParsedBody();
        $this->connectUsTableGateway->insert(['username' => $data['username'],
            'email' => $data['email']]);
        return new TextResponse('DATA INSERT');

    }
}