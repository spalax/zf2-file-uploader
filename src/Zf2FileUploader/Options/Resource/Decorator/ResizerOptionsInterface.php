<?php
namespace Zf2FileUploader\Options\Resource\Decorator;

interface ResizerOptionsInterface
{
    /**
     * @return int
     */
    public function getResizeWidth();

    /**
     * @return int
     */
    public function getResizeHeight();
}
