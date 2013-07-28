<?php
namespace Zf2FileUploader\Resource\Handler\Decorator\Image;

use Zf2FileUploader\Options\Resource\Decorator\ResizerOptionsInterface;
use Zf2FileUploader\Resource\Handler\Decorator\Exception\DomainException;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface as ImagineImageInterface;
use Imagine\Gd\Imagine;
use Zf2FileUploader\Resource\Handler\Decorator\ImageDecoratorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;

class Resizer implements ImageDecoratorInterface
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
     * @param ImageResourceInterface $resource
     * @return string
     */
    protected function getSavePath(ImageResourceInterface $resource)
    {
        return $resource->getPath();
    }

    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function decorate(ImageResourceInterface $resource)
    {
        $imagine = new Imagine();

        $image = $imagine->open($resource->getPath());

        $sizeBox = null;

        $sizeBox = new Box($this->width, $this->height);
        $mode = ImagineImageInterface::THUMBNAIL_OUTBOUND;

        if (!is_null($sizeBox)) {
            $image->thumbnail($sizeBox, $mode)
                  ->save($this->getSavePath($resource),
                         array('format'=>$resource->getExt()));
        } else {
            return false;
        }

        return true;
    }
}