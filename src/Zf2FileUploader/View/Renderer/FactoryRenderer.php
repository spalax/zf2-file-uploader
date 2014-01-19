<?php
namespace Zf2FileUploader\View\Renderer;

use Zend\Stdlib\Parameters;
use Zend\View\Renderer\RendererInterface;
use Zf2FileUploader\View\Renderer\CKEditorRenderer;
use Zf2Libs\View\Renderer\TextAreaRenderer;

/**
 * Zf2FileUploader renderer factory
 */
class FactoryRenderer
{
    /**
     * @param Parameters $params [OPTIONAL]
     * @return RendererInterface
     */
    public function createRenderer(Parameters $params = null)
    {
        if (!is_null($params) && $params->get('CKEditor', false) !== false) {
            return new CKEditorRenderer($params);
        }

        return new TextAreaRenderer();
    }
}
