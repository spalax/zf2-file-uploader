<?php
namespace Zf2FileUploader\Resource\Persister\Image;

use Zend\Filter\File\Rename;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Resource\Persister\AbstractFilesystemPersister;
use Zf2FileUploader\Resource\Persister\ImagePersisterInterface;

class FilesystemPersister extends AbstractFilesystemPersister implements ImagePersisterInterface
{
    /**
     * @var ImageResourceOptionsInterface
     */
    protected $options;

    /**
     * @var \Callable
     */
    protected $revertClb = null;

    public function __construct(ImageResourceOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function persist(ImageResourceInterface $resource)
    {
        $ext = $resource->getExt();
        $baseName = uniqid().($ext ? '.'.$ext : '');
        $target = realpath($this->options->getImagePersistentPath()).'/'.$baseName;

        $moveUploadedFilter = new Rename(array(
            'target'               => $target,
            'overwrite'            => false,
            'randomize'            => false,
        ));

        $moveUploadedFilter->filter($resource->getPath());

        $resource->setPath($target);
        $resource->setHttpPath($this->options->getImageHttpPath().'/'.$baseName);

        $this->setCallbacks(null, function () use ($target) {
            if (file_exists($target)) {
                unlink($target);
            }
        });

        return file_exists($target);
    }
}