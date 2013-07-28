<?php
namespace Zf2FileUploader\Service\Image;


use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Service\Exception\DecoratorException;
use Zf2FileUploader\Service\Exception\PersisterException;

interface SaveServiceInterface
{
    /**
     * @param ImageResourceInterface $resource
     * @throws \Exception
     * @throws PersisterException
     * @throws DecoratorException
     */
    public function save(ImageResourceInterface $resource);
}