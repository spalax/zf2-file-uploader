<?php
namespace Zf2FileUploader\Service\Image;


use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Service\Response\ImageResponseInterface;

interface SaveServiceInterface
{
    /**
     * @param ImageResourceInterface $resource
     * @param ImageResponseInterface $response
     * @return ImageResponseInterface
     * @throws \Exception
     */
    public function save(ImageResourceInterface $resource, ImageResponseInterface $response = null);

    /**
     * @param ImageResourceInterface[] $resources
     * @return ImageResourceInterface[]
     */
    public function saveCollection(array $resources);
}