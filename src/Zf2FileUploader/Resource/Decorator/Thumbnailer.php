<?php
namespace Zf2FileUploader\Resource\Decorator;

use Zf2FileUploader\Options\Resource\Decorator\ThumbnailerOptionsInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\Resource\Decorator\Exception\DomainException;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface as ImagineImageInterface;
use Imagine\Gd\Imagine;

class Thumbnailer implements DecoratorInterface
{
    /**
     * @var array
     */
    protected $thumbnails = array();

    /**
     * @param string | ThumbnailerOptionsInterface $options
     */
    public function __construct($options)
    {
        if (is_string($options) && ($thumb = $this->getSizeFromThumb($options))) {
            $this->thumbnails[] = $thumb;
        } else if ($options instanceof ThumbnailerOptionsInterface) {
             foreach ($options->setThumbnailerThumbs() as $thumb) {
                 $this->thumbnails[] = $this->getSizeFromThumb($thumb);
             }
        } else {
            throw new DomainException('Could not handle defined options, it is might be string format 1500x200 or
                                       type ThumbnailerOptionsInterface');
        }
    }

    /**
     * @param string $thumb
     * @return bool
     */
    protected function getSizeFromThumb($thumb)
    {
        if (preg_match('/^(?P<width>[0-9]+)x(?P<height>[0-9]+)$/', $thumb, $matches)) {
            return array('width'=>$matches['width'], 'height'=>$matches['height']);
        } else {
            return false;
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

        $mode = ImagineImageInterface::THUMBNAIL_OUTBOUND;

        $pathInfo = pathinfo($resource->getPath());
        $ext = $pathInfo[PATHINFO_EXTENSION];
        $baseName = $pathInfo[PATHINFO_BASENAME];
        $dirName = $pathInfo[PATHINFO_DIRNAME];


        foreach ($this->thumbnails as $thumbnail) {
            $sizeBox = new Box($thumbnail['width'], $thumbnail['height']);

            if (!is_null($sizeBox)) {
                $image->thumbnail($sizeBox, $mode)
                      ->save(sprintf('%s/%s_%sx%s.%s',$dirName,$baseName,
                                                      $thumbnail['width'],
                                                      $thumbnail['height'], $ext),
                             array('format'=>$resource->getExt()));
            } else {
                return false;
            }
        }

        return true;
    }
}