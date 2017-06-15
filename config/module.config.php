<?php

return [
    'view_manager'    => [
        'strategies' => [
            \ZFDomPdf\View\Strategy\PdfStrategy::class,
        ],
    ],
    'service_manager' => [
        'shared'    => [
            /**
             * DOMPDF itself has issues rendering twice in a row so we force a
             * new instance to be created.
             */
            \Dompdf\Dompdf::class => false,
        ],
        'factories' => [
            \Dompdf\Dompdf::class                      => \ZFDomPdf\Service\Factory\DompdfFactory::class,
            \ZFDomPdf\Config\ModuleConfig::class       => \ZFDomPdf\Config\Factory\ModuleConfigFactory::class,
            \ZFDomPdf\View\Renderer\PdfRenderer::class => \ZFDomPdf\View\Renderer\Factory\PdfRendererFactory::class,
            \ZFDomPdf\View\Strategy\PdfStrategy::class => \ZFDomPdf\View\Strategy\Factory\PdfStrategyFactory::class,
        ],
    ],
];
