<?php
namespace Zf2FileUploader\Resource\Handler\Processor\Image;

use Imagine\Image\BoxInterface as ImageBoxInterface;
use Imagine\Image\ImageInterface as ImagineImageInterface;
use Imagine\Image\ImagineInterface;
use Zend\Filter\FilterInterface;
use Zf2FileUploader\Resource\Handler\Processor\ImageProcessorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;

class Thumbnail implements ImageProcessorInterface
{
    /**
     * @var ImagineInterface
     */
    protected $imageService;

    /**
     * @var ImageBoxInterface
     */
    protected $imageBox;

    /**
     * @var FilterInterface | null
     */
    protected $pathFilter = null;

    /**
     * @param ImagineInterface $imageService
     * @param ImageBoxInterface $imageBox
     * @param FilterInterface $pathFilter
     */
    public function __construct(ImagineInterface $imageService,
                                ImageBoxInterface $imageBox,
                                FilterInterface $pathFilter = null)
    {
        $this->imageService = $imageService;
        $this->imageBox = $imageBox;
        $this->pathFilter = $pathFilter;
    }

    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function process(ImageResourceInterface $resource)
    {
        $image = $this->imageService->open($resource->getPath());

        $mode = ImagineImageInterface::THUMBNAIL_OUTBOUND;

        $image->thumbnail($this->imageBox, $mode)
              ->save(!is_null($this->pathFilter) ?
                      $this->pathFilter->filter($resource->getPath()) :
                      $resource->getPath(),
                     array('format'=>$resource->getExt()));

        return true;
    }
}