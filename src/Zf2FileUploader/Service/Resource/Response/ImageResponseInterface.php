<?php
namespace Zf2FileUploader\Service\Resource\Response;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface ImageResponseInterface extends ResponseInterface
{
    /**
     * @return ImageResourceInterface
     */
    public function getResource();
}