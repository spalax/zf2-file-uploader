<?php
namespace Zf2FileUploader\Resource\Persister\Image;

use Zend\Filter\File\Rename;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Resource\Persister\AbstractFilesystemPersister;
use Zf2FileUploader\Resource\ResourceInterface;

class FilesystemPersister extends AbstractFilesystemPersister
{
    /**
     * @var ImageResourceOptionsInterface
     */
    protected $options;

    public function __construct(ImageResourceOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function persist(ResourceInterface $resource)
    {
        $ext = $resource->getExt();
        $baseName = uniqid().($ext ? '.'.$ext : '');
        $target = realpath($this->options->getImagePersistentPath()).'/'.$baseName;

        $moveUploadedFilter = new Rename(array(
            'target'               => $target,
            'overwrite'            => false,
            'randomize'            => false,
        ));

        $oldPath = $resource->getPath();
        $oldHttpPath = $resource->getHttpPath();

        $moveUploadedFilter->filter($resource->getPath());

        $resource->setPath($target);
        $resource->setHttpPath($this->options->getImageHttpPath().'/'.$baseName);

        $this->setCallbacks(null, function () use ($resource, $target, $oldPath, $oldHttpPath) {
            if (file_exists($target)) {
                $moveUploadedFilter = new Rename(array(
                    'target'               => $oldPath,
                    'overwrite'            => false,
                    'randomize'            => false,
                ));
                $moveUploadedFilter->filter($target);
            }

            $resource->setPath($oldPath);
            $resource->setHttpPath($oldHttpPath);
        });

        return file_exists($target);
    }
}