<?php
namespace Zf2FileUploader\Service\Resource\Image;


use Zf2FileUploader\Entity\ImageBindInterface;
use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;

interface BindServiceInterface
{
    /**
     * @param ImageResourceInterface $resource
     * @param ImageBindInterface $binder
     * @return void
     */
    public function bind(ImageResourceInterface $resource, ImageBindInterface $binder);

    /**
     * @param ImageResourceInterface[] $resources
     * @return void
     */
    public function bindCollection(array $resources, ImageBindInterface $binder);
}