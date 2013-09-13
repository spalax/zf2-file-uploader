<?php
namespace Zf2FileUploader\Resource\Handler\Persister\Image;

use Zend\Filter\File\Rename;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Resource\Handler\Persister\AbstractFilesystemPersister;
use Zf2FileUploader\Resource\Handler\Persister\ImagePersisterInterface;

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
        $baseName = $resource->getToken().($ext ? '.'.$ext : '');
        $target = realpath($this->options->getImagePersistentPath()).'/'.$baseName;

        $moveUploadedFilter = new Rename(array(
            'target'               => $target,
            'overwrite'            => false,
            'randomize'            => false,
        ));

        $moveUploadedFilter->filter($resource->getPath());

        $resource->setPath($target);

        $result = file_exists($target);
        if ($result) {
            $result = chmod($target, 0664);
        }

        $resource->setHttpPath($this->options->getImageHttpPath().'/'.$baseName);

        $this->setCallbacks(null, function () use ($target) {
            if (file_exists($target)) {
                unlink($target);
            }
        });

        return $result;
    }
}