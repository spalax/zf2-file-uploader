<?php
namespace Zf2FileUploader\Resource\Handler\Processor\Image;

use Imagine\Image\BoxInterface as ImageBoxInterface;
use Imagine\Image\ImageInterface as ImagineImageInterface;
use Imagine\Image\ImagineInterface;
use Zf2FileUploader\Image\Box\ImageBoxFactoryInterface;
use Zf2FileUploader\Resource\Handler\Processor\ImageProcessorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;

class Resize implements ImageProcessorInterface
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
     * @param string | array $data allowed format 100x100, array('width'=>100, 'height'=>100)
     * @param ImagineInterface $imageService
     * @param \Zf2FileUploader\Image\Box\ImageBoxFactoryInterface $imageBoxFactory
     */
    public function __construct($data,
                                ImagineInterface $imageService,
                                ImageBoxFactoryInterface $imageBoxFactory)
    {
        $this->imageService = $imageService;
        $this->imageBox = $imageBoxFactory->getImageBox($data);
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
            ->save($resource->getPath(),
                   array('format'=>$resource->getExt()));

        return true;
    }
}
