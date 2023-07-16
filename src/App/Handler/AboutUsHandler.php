<?php
declare(strict_types=1);

namespace App\Handler;


use App\DB\ConnectUsTableGateway;
use App\Form\AboutUsForm;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;

class AboutUsHandler implements RequestHandlerInterface
{
    private TemplateRendererInterface $templateRenderer;
    private AboutUsForm $aboutUsForm;
    private ConnectUsTableGateway $connectUsTableGateway;
    /**
     * @param TemplateRendererInterface $templateRenderer
     * @param AboutUsForm $aboutUsForm
     */
    public function __construct(TemplateRendererInterface $templateRenderer, AboutUsForm $aboutUsForm,ConnectUsTableGateway $connectUsTableGateway)
    {
        $this->templateRenderer = $templateRenderer;
        $this->aboutUsForm = $aboutUsForm;
        $this->connectUsTableGateway = $connectUsTableGateway;
    }

    public function Handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === 'GET') {
            return new HtmlResponse(
                $this->templateRenderer->render('app::aboutus',
                    ['AboutUs' => $this->aboutUsForm->getMessages()]
                )
            );
        }

        $this->aboutUsForm->SetData($request->getParsedBody());
        $isValid = $this->aboutUsForm->isValid();

        if (!$isValid) {
            return new HtmlResponse(
                $this->templateRenderer->render('app::aboutus',
                    ['FormMessages' => $this->aboutUsForm->getMessages()]
                )
            );

        }
        return new RedirectResponse('/shoppinghandler');

    }
}