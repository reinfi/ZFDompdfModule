<?php

namespace ZFDomPdf\View\Renderer;

use Dompdf\Dompdf;
use ZFDomPdf\View\Model\PdfModel;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\ResolverInterface;

/**
 * @package ZFDomPdf\View\Renderer
 */
class PdfRenderer implements RendererInterface
{
    /**
     * @var Dompdf
     */
    private $dompdf = null;

    /**
     * @var ResolverInterface
     */
    private $resolver = null;

    /**
     * @var RendererInterface
     */
    private $htmlRenderer = null;

    /**
     * @param PdfModel $nameOrModel
     * @param null     $values
     *
     * @return string
     */
    public function render($nameOrModel, $values = null)
    {
        $html = $this->htmlRenderer->render($nameOrModel, $values);

        $paperSize = $nameOrModel->getOption('paperSize');
        $paperOrientation = $nameOrModel->getOption('paperOrientation');
        $basePath = $nameOrModel->getOption('basePath');

        $pdf = $this->dompdf;
        $pdf->setPaper($paperSize, $paperOrientation);
        $pdf->setBasePath($basePath);

        $pdf->loadHtml($html);
        $pdf->render();

        return $pdf->output();
    }

    /**
     * @param ResolverInterface $resolver
     *
     * @return $this
     */
    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    /**
     * @param RendererInterface $renderer
     *
     * @return $this
     */
    public function setHtmlRenderer(RendererInterface $renderer)
    {
        $this->htmlRenderer = $renderer;

        return $this;
    }

    /**
     * @param Dompdf $dompdf
     *
     * @return $this
     */
    public function setEngine(Dompdf $dompdf)
    {
        $this->dompdf = $dompdf;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEngine()
    {
        return $this->dompdf;
    }
}
