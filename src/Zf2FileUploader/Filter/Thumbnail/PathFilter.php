<?php
namespace Zf2FileUploader\Filter\Thumbnail;

use Imagine\Image\BoxInterface;
use Zend\Filter\Exception;
use Zend\Filter\FilterInterface;

class PathFilter implements FilterInterface
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @param array | BoxInterface $data
     */
    public function __construct($data)
    {
        if ($data instanceof BoxInterface) {
            $this->width = $data->getWidth();
            $this->height = $data->getHeight();
        } else if (func_num_args() > 1) {
            list($this->width, $this->height) = func_get_args();
        } else if (is_array($data) && array_key_exists('width', $data) && array_key_exists('height', $data)) {
            $this->width = $data['width'];
            $this->height = $data['height'];
        }
    }

    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value It is must be path to file on FS
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {
        $pathInfo = pathinfo($value);
        return sprintf('%s/%s_%sx%s.%s', $pathInfo['dirname'], $pathInfo['filename'],
                                         $this->width, $this->height, $pathInfo['extension']);
    }
}