<?php
namespace Zf2FileUploader\Filter\Thumbnail;

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
     * @param int $width
     * @param int $height
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
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