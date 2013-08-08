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
        if (!(is_array($data) && array_key_exists('width', $data) && array_key_exists('height', $data)) &&
            !(preg_match('/^(?P<width>[0-9]+)x(?P<height>[0-9]+)$/', $data, $data))) {
            throw new Exception\InvalidArgumentException("Could not retrieve width and height from data for ImageBox");
        }

        $width = $data['width'];
        $height = $data['height'];

        $box = new Box($width, $height);

        if (array_key_exists('strategy', $data)) {
            if ($data['strategy'] == 'widen') {
                $box->widen($width);
            }else if ($data['strategy'] == 'heighten') {
                $box->heighten($height);
            }
        }

        return $box;
    }
}