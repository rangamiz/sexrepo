<?php
declare(strict_types=1);
namespace App\Handler;

use App\Form\ConnectUsForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Template\TemplateRendererInterface;
class ConnectUsHandler implements RequestHandlerInterface
{
    private TemplateRendererInterface $templateRenderer;
    private ConnectUsForm $connectUsForm;
    public function __construct(TemplateRendererInterface $templateRenderer,ConnectUsForm $connectUsForm)
    {
     $this->templateRenderer = $templateRenderer;
     $this->connectUsForm = $connectUsForm;

    }
    public function Handle(ServerRequestInterface $request): ResponseInterface
    {
        if($request->getMethod() === 'GET') {
            return new HtmlResponse($this->templateRenderer->render('app::connectUs',
                ['ConnectUs' => $this->connectUsForm->getMessages()]));
        }
        $this->connectUsForm->setData($request->getParsedBody());
        $isValid = $this->connectUsForm->IsValid();
        if(!$isValid){
            return new HtmlResponse($this->templateRenderer->render(
                'app::connectUs',
                ['FormMassages'=>$this->connectUsForm->getMessages()]
            ) );
        }
        return new RedirectResponse('/ConnectUsHandler');

    }
}