<?php

namespace ZFDomPdf\View\Model;

use Zend\View\Model\ViewModel;

/**
 * @package ZFDomPdf\View\Model
 */
class PdfModel extends ViewModel
{
    /**
     * @var array
     */
    protected $options = array(
        'paperSize' => '8x11',
        'paperOrientation' => 'portrait',
        'basePath' => '/',
        'fileName' => null
    );
    
    /**
     * PDF probably won't need to be captured into a
     * a parent container by default.
     *
     * @var string
     */
    protected $captureTo = null;

    /**
     * PDF is usually terminal
     *
     * @var bool
     */
    protected $terminate = true;
}
