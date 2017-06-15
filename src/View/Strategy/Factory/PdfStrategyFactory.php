<?php

namespace ZFDomPdf\View\Strategy\Factory;

use ZFDomPdf\View\Renderer\PdfRenderer;
use ZFDomPdf\View\Strategy\PdfStrategy;
use Psr\Container\ContainerInterface;

/**
 * @package ZFDomPdf\View\Strategy\Factory
 */
class PdfStrategyFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PdfStrategy
     */
    public function __invoke(ContainerInterface $container)
    {
        $pdfRenderer = $container->get(PdfRenderer::class);

        return new PdfStrategy($pdfRenderer);
    }
}