<?php
namespace Zf2FileUploader\Filter\Thumbnail;

use Imagine\Image\BoxInterface;
use Zend\Filter\Exception;

class PathFilterFactory implements PathFilterFactoryInterface
{
    /**
     * @param array | BoxInterface $data
     *
     * @return PathFilter
     */
    public function getPathFilter($data)
    {
        if ($data instanceof BoxInterface) {
            $width = $data->getWidth();
            $height = $data->getHeight();
        } else if (func_num_args() > 1) {
            list($width, $height) = func_get_args();
        } else if ((is_array($data) && array_key_exists('width', $data) && array_key_exists('height', $data)) ||
                   preg_match('/^(?P<width>[0-9]+)x(?P<height>[0-9]+)$/', $data, $data)) {
            $width = $data['width'];
            $height = $data['height'];
        } else {
            throw new Exception\InvalidArgumentException("Could not retrieve width and height from data");
        }

        return new PathFilter($width, $height);
    }
}