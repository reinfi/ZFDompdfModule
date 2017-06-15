ZFDompdfModule
============

The DOMPDF module integrates the DOMPDF library with Zend Framework 2 with minimal
effort on the consumer's end.

## Requirements
  - [Zend Framework 2](http://www.github.com/zendframework/zf2)

## Installation
Installation of DOMPDFModule uses PHP Composer. For more information about
PHP Composer, please visit the official [PHP Composer site](http://getcomposer.org/).

#### Installation steps

  1. composer require "reinfi/zf-dompdf-module"
  2. open `my/project/directory/config/application.config.php` and add the following key to your `modules`: 

     ```php
     'ZFDomPdf',
     ```
#### Configuration options
You can override options via the `dompdf` key in your local or global config files.
See Dompdf class for all options.

## Usage

```php
<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZFDomPdf\View\Model\PdfModel;

class ReportController extends AbstractActionController
{
    public function monthlyReportPdfAction()
    {
        $pdf = new PdfModel();
        $pdf->setOption('filename', 'monthly-report'); // Triggers PDF download, automatically appends ".pdf"
        $pdf->setOption('paperSize', 'a4'); // Defaults to "8x11"
        $pdf->setOption('paperOrientation', 'landscape'); // Defaults to "portrait"
        
        // To set view variables
        $pdf->setVariables(array(
          'message' => 'Hello'
        ));
        
        return $pdf;
    }
}
```
