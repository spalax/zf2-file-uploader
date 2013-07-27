<?php
namespace Zf2FileUploader\Service\Resource\Image;

use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Service\Resource\Response\ImageResponseInterface;

interface DecorateServiceInterface
{
    /**
     * @param ImageResourceInterface $resource
     * @param ImageResponseInterface $response
     * @return ImageResponseInterface
     * @throws \Exception
     */
    public function decorate(ImageResourceInterface $resource, ImageResponseInterface $response = null);

    /**
     * @param ImageResourceInterface[] $resources
     * @return ImageResourceInterface[]
     */
    public function decorateCollection(array $resources);
}