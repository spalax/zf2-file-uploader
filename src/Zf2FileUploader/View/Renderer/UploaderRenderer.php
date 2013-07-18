<?php
namespace Zf2FileUploader\View\Renderer;

use Zend\Form\Element\Textarea;
use Zend\Form\View\Helper\FormTextarea;
use Zend\Json\Json;
use Zend\View\Exception;
use Zend\View\Model\ModelInterface;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;
use Zf2FileUploader\View\Renderer\Exception\InvalidArgumentException;

/**
 * Zf2FileUploader renderer
 */
class UploaderRenderer implements Renderer, TreeRendererInterface
{
    /**
     * @var Resolver
     */
    protected $resolver;

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
     * @param ModelInterface $model
     * @param null $values
     * @return string
     * @throws Exception\InvalidArgumentException
     */
    public function render($model, $values = null)
    {
        if (!$model instanceof ModelInterface) {
            throw new InvalidArgumentException("Unsupportable type of model, required type ModelInterface");
        }

        $textArea = new Textarea();
        $textArea->setName('response');

        $textAreaViewHelper = new FormTextarea();

        $jsonEncoder = new Json();
        $value = $jsonEncoder->encode($model->getVariables());

        $textArea->setValue($value);

        return $textAreaViewHelper->render($textArea);
    }

    /**
     * Can this renderer render trees of view models?
     *
     * No.
     *
     * @return false
     */
    public function canRenderTrees()
    {
        return false;
    }
}
