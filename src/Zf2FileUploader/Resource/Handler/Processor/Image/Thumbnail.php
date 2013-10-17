<?php
namespace Zf2FileUploader\Resource\Handler\Processor\Image;

use Imagine\Image\BoxInterface as ImageBoxInterface;
use Imagine\Image\ImageInterface as ImagineImageInterface;
use Imagine\Image\ImagineInterface;
use Zend\Filter\FilterInterface;
use Zf2FileUploader\Filter\Thumbnail\PathFilterFactoryInterface;
use Zf2FileUploader\Image\Box\ImageBoxFactoryInterface;
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
     * @var FilterInterface
     */
    protected $pathFilter;

    /**
     * @param string | array $data allowed format 100x100, array('width'=>100, 'height'=>100)
     * @param ImagineInterface $imageService
     * @param ImageBoxInterface $imageBox
     * @param FilterInterface $pathFilter
     */
    public function __construct($data,
                                ImagineInterface $imageService,
                                ImageBoxFactoryInterface $imageBoxFactory,
                                PathFilterFactoryInterface $pathFilterFactory)
    {
        $this->imageService = $imageService;
        $this->imageBox = $imageBoxFactory->getImageBox($data);
        $this->pathFilter = $pathFilterFactory->getPathFilter($this->imageBox);
    }

    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function process(ImageResourceInterface $resource)
    {
        $image = $this->imageService->open($resource->getPath());

        $mode = ImagineImageInterface::THUMBNAIL_INSET;

        $image->thumbnail($this->imageBox, $mode)
              ->save($this->pathFilter->filter($resource->getPath()),
                     array('format'=>$resource->getExt(),
                           'quality'=>'100'));

        return true;
    }
}