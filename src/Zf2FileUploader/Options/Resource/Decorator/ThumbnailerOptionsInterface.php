<?php
namespace Zf2FileUploader\Options\Resource\Decorator;

interface ThumbnailerOptionsInterface
{
    /**
     * @param string | array $thumbnailerThumbs
     * @return array
     */
    public function setThumbnailerThumbs($thumbnailerThumbs);
}
