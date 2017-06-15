<?php

namespace ZFDomPdf\Config\Factory;

use Psr\Container\ContainerInterface;

/**
 * @package ZFDomPdf\Config\Factory
 */
class ModuleConfigFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return array
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        return isset($config['dompdf']) ?
            $config['dompdf'] :
            [];
    }
}