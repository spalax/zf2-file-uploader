<?php
namespace Zf2FileUploader\View\Renderer;

use Zend\Stdlib\Parameters;
use Zend\View\Exception;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;
use Zf2FileUploader\View\Model\UploaderModelInterface;
use Zf2Libs\View\Renderer\Exception\InvalidArgumentException;

/**
 * Zf2FileUploader renderer
 */
class CKEditorRenderer implements Renderer, TreeRendererInterface
{
    /**
     * @var Resolver
     */
    protected $resolver;

    /**
     * @var Parameters
     */
    protected $params;

    public function __construct(Parameters $params)
    {
        $this->params = $params;
    }

    /**
     * @return $this
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * @param Resolver $resolver
     * @return $this
     */
    public function setResolver(Resolver $resolver)
    {
        return $this;
    }

    /**
     * @param UploaderModelInterface $model
     * @param null $values
     * @return string
     * @throws InvalidArgumentException
     */
    public function render($model, $values = null)
    {
        if (!$model instanceof UploaderModelInterface) {
            throw new InvalidArgumentException("Unsupportable type of model, required type UploaderModelInterface");
        }

        $resources = $model->getResourcePaths();
        $url = array_pop($resources);
        $funcNum = $this->params->get('CKEditorFuncNum', 0);

        return "<script type='text/javascript'>
                    window.parent.CKEDITOR.tools.callFunction($funcNum, '".$url."', '');
                </script>";
    }

    /**
     * Can this renderer render trees of view models?
     *
     * No.
     *
     * @return boolean
     */
    public function canRenderTrees()
    {
        return false;
    }
}
