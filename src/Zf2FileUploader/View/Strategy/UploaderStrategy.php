<?php
namespace Zf2FileUploader\View\Strategy;

use Zend\View\Renderer\RendererInterface;
use Zf2FileUploader\View\Model\UploaderModelInterface;
use Zf2FileUploader\View\Renderer\FactoryRenderer;
use Zf2Libs\View\Strategy\UploaderStrategy as BaseUploaderStrategy;
use Zend\View\ViewEvent;

class UploaderStrategy extends BaseUploaderStrategy
{
    /**
     * @var FactoryRenderer
     */
    protected $rendererFactory;

    /**
     * Constructor
     *
     * @param  FactoryRenderer $rendererFactory
     */
    public function __construct(FactoryRenderer $rendererFactory)
    {
        $this->rendererFactory = $rendererFactory;
    }

    /**
     * Detect if we should use the UploaderRenderer based on model type and/or
     * Accept header
     *
     * @param  ViewEvent $e
     * @return null | RendererInterface
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if (!$model instanceof UploaderModelInterface) {
            return null;
        }

        $this->renderer = $this->rendererFactory
                               ->createRenderer($e->getRequest()
                                                  ->getQuery());

        // JsonModel found
        return $this->renderer;
    }
}
