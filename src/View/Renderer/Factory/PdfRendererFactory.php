<?php

namespace ZFDomPdf\View\Renderer\Factory;

use Dompdf\Dompdf;
use ZFDomPdf\View\Renderer\PdfRenderer;
use Interop\Container\ContainerInterface;
use Zend\Mvc\View\Http\ViewManager;
use Zend\View\Renderer\PhpRenderer;

/**
 * @package ZFDomPdf\View\Renderer\Factory
 */
class PdfRendererFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PdfRenderer
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var ViewManager $viewManager */
        $viewManager = $container->get('ViewManager');

        $pdfRenderer = new PdfRenderer();

        $pdfRenderer->setResolver($container->get('ViewResolver'));
        $pdfRenderer->setHtmlRenderer($container->get(PhpRenderer::class));
        $pdfRenderer->setEngine($container->get(Dompdf::class));

        return $pdfRenderer;
    }
}