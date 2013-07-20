<?php
namespace Zf2FileUploader\Resource\Persister;

use Zend\Filter\File\RenameUpload;
use Zf2FileUploader\Options\PersisterOptionsInterface;
use Zf2FileUploader\Resource\Persister\PersisterInterface;
use Zf2FileUploader\Resource\ResourceInterface;

class FilesystemPersister implements PersisterInterface
{
    /**
     * @var PersisterOptionsInterface
     */
    protected $options;

    /**
     * @var \Callable
     */
    protected $persisted = null;

    public function __construct(PersisterOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function persist(ResourceInterface $resource)
    {
        $this->persisted = null;
        $ext = pathinfo($resource->getPath(), PATHINFO_EXTENSION);

        $target = realpath($this->options->getPersistentPath()).'/'.uniqid().($ext ? '.'.$ext : '');

        $moveUploadedFilter = new RenameUpload(array(
            'target'               => $target,
            'use_upload_name'      => false,
            'use_upload_extension' => true,
            'overwrite'            => false,
            'randomize'            => false,
        ));

        $resource->setPath($target);

        $this->persisted = function () use ($resource, $moveUploadedFilter) {
            try {
                $moveUploadedFilter->filter($resource->getPath());
            } catch (\Exception $e) {
                return false;
            }
            return true;
        };

        return true;
    }

    /**
     * @return bool
     */
    public function flush()
    {
        $func = $this->persisted;
        return $func();
    }

    public function revert()
    {
        $this->persisted = null;
        return true;
    }
}