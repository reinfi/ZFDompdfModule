<?php

namespace ZFDomPdf\Service\Factory;

use Dompdf\Dompdf;
use Psr\Container\ContainerInterface;
use ZFDomPdf\Config\ModuleConfig;

/**
 * @package ZFDomPdf\Service\Factory
 */
class DompdfFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Dompdf
     */
    public function __invoke(ContainerInterface $container)
    {
        $dompdfConfig = $container->get(ModuleConfig::class);

        return new Dompdf($dompdfConfig);
    }
}
