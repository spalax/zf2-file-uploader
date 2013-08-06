<?php
namespace Zf2FileUploader\Image\Box;

use Imagine\Image\Box;

class ImageBoxFactory implements ImageBoxFactoryInterface
{
    /**
     * @param string | array $data
     * @return Box
     */
    public function getImageBox($data)
    {
        if (func_num_args() > 1) {
            list($width, $height) = func_get_args();
        } else if ((is_array($data) && array_key_exists('width', $data) && array_key_exists('height', $data))
                   || preg_match('/^(?P<width>[0-9]+)x(?P<height>[0-9]+)$/', $data, $data)) {
            $width = $data['width'];
            $height = $data['height'];
        } else {
            throw new Exception\InvalidArgumentException("Could not retrieve width and height from data for ImageBox");
        }

        return new Box($width, $height);
    }
}