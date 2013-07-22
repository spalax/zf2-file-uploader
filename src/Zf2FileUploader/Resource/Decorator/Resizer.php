<?php
namespace Zf2FileUploader\Resource\Decorator;

use Zf2FileUploader\Options\Resource\Decorator\ResizerOptionsInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\Resource\Decorator\Exception\DomainException;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface as ImagineImageInterface;
use Imagine\Gd\Imagine;

class Resizer implements DecoratorInterface
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    public function __construct($options)
    {
        if (is_array($options) && count($options) == 2) {
            list($this->width, $this->height) = $options;
        } else if ($options instanceof ResizerOptionsInterface) {
            $this->width = $options->getResizeWidth();
            $this->height = $options->getResizeHeight();
        } else {
            throw new DomainException('Could not handle defined options, it is might be array of width,
                                       height or type ResizerOptionsInterface');
        }
    }

    /**
     * @param DecoratorInterface $resource
     * @return boolean
     */
    public function decorate(ResourceInterface $resource)
    {
        $imagine = new Imagine();

        $image = $imagine->open($resource->getPath());

        $sizeBox = null;

        $sizeBox = new Box($this->width, $this->height);
        $mode = ImagineImageInterface::THUMBNAIL_OUTBOUND;

        if (!is_null($sizeBox)) {
            $image->thumbnail($sizeBox, $mode)
                  ->save($resource->getPath(), array('format'=>$resource->getExt()));
        }

        return true;
    }
}