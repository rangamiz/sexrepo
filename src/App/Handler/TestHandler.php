<?php
declare(strict_types=1);

namespace App\Handler;

use App\Form\TestForm;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class TestHandler implements RequestHandlerInterface
{
    private TemplateRendererInterface $templateRenderer;
    private TestForm $testForm;

    public function __construct(TemplateRendererInterface $templateRenderer, TestForm $testForm)
    {
        $this->templateRenderer = $templateRenderer;
        $this->testForm = $testForm;
    }

    public function Handle(ServerRequestInterface $request): HtmlResponse
    {
        if ($request->getMethod() === 'GET') {
            return new HtmlResponse($this->templateRenderer->render('app::test',
                ['Test' => $this->testForm->getMessages()]));
        }
        $this->testForm->setData($request->getParsedBody());
        $isValid = $this->testForm->IsValid();
        if (!$isValid) {
            return new HtmlResponse($this->templateRenderer->render('app::test',
                ['FormMassages' => $this->testForm->getMessages()]));
        }
        return new  RedirectResponse('/TestForm');

    }
}


