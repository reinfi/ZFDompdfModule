<?php

namespace ZFDomPdf\View\Strategy;

use ZFDomPdf\View\Model;
use ZFDomPdf\View\Renderer\PdfRenderer;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\View\ViewEvent;

/**
 * @package ZFDomPdf\View\Strategy
 */
class PdfStrategy implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @var PdfRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param  PdfRenderer $renderer
     */
    public function __construct(PdfRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Attach the aggregate to the specified event manager
     *
     * @param  EventManagerInterface $events
     * @param  int                   $priority
     *
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            ViewEvent::EVENT_RENDERER, [ $this, 'selectRenderer' ], $priority
        );
        $this->listeners[] = $events->attach(
            ViewEvent::EVENT_RESPONSE, [ $this, 'injectResponse' ], $priority
        );
    }

    /**
     * @param  ViewEvent $event
     *
     * @return null|PdfRenderer
     */
    public function selectRenderer(ViewEvent $event)
    {
        $model = $event->getModel();

        if ($model instanceof Model\PdfModel) {
            return $this->renderer;
        }

        return null;
    }

    /**
     * Inject the response with the PDF payload and appropriate Content-Type header
     *
     * @param  ViewEvent $event
     *
     * @return void
     */
    public function injectResponse(ViewEvent $event)
    {
        $renderer = $event->getRenderer();
        if ($renderer !== $this->renderer) {
            // Discovered renderer is not ours; do nothing
            return;
        }

        $result = $event->getResult();

        if (!is_string($result)) {
            return;
        }

        $response = $event->getResponse();
        $response->setContent($result);
        $response->getHeaders()->addHeaderLine(
            'content-type', 'application/pdf'
        );

        $fileName = $event->getModel()->getOption('filename');
        if (isset($fileName)) {
            if (substr($fileName, -4) != '.pdf') {
                $fileName .= '.pdf';
            }

            $response->getHeaders()->addHeaderLine(
                'Content-Disposition',
                'attachment; filename=' . $fileName
            );
        }
    }
}
