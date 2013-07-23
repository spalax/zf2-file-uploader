<?php
namespace Zf2FileUploader\Resource\Persister;

use Zend\Filter\File\Rename;
use Zf2FileUploader\Options\ResourceOptionsInterface;
use Zf2FileUploader\Resource\ResourceInterface;

class FilesystemPersister extends AbstractFilesystemPersister
{
    /**
     * @var ResourceOptionsInterface
     */
    protected $options;

    /**
     * @var \Callable
     */
    protected $revertClb = null;

    public function __construct(ResourceOptionsInterface $options)
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
        $target = realpath($this->options->getResourcePersistentPath()).'/'.$baseName;

        $moveUploadedFilter = new Rename(array(
            'target'               => $target,
            'overwrite'            => false,
            'randomize'            => false,
        ));

        $moveUploadedFilter->filter($resource->getPath());

        $resource->setPath($target);
        $resource->setHttpPath($this->options->getResourceHttpPath().'/'.$baseName);

        $this->setCallbacks(null, function () use ($target) {
            if (file_exists($target)) {
                unlink($target);
            }
        });

        return file_exists($target);
    }
}