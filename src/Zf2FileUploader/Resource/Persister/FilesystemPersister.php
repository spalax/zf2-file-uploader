<?php
namespace Zf2FileUploader\Resource\Persister;

use Zend\Filter\File\Rename;
use Zf2FileUploader\Options\PersisterOptionsInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2Libs\Filter\File\ExtensionExtractor;

class FilesystemPersister extends AbstractFilesystemPersister
{
    /**
     * @var PersisterOptionsInterface
     */
    protected $options;

    /**
     * @var \Callable
     */
    protected $revertClb = null;

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
        $ext = $resource->getExt();
        $target = realpath($this->options->getPersistentPath()).'/'.uniqid().($ext ? '.'.$ext : '');

        $moveUploadedFilter = new Rename(array(
            'target'               => $target,
            'overwrite'            => false,
            'randomize'            => false,
        ));

        $moveUploadedFilter->filter($resource->getPath());
        $resource->setPath($target);

        $this->setCallbacks(null, function () use ($target) {
            if (file_exists($target)) {
                unlink($target);
            }
        });

        return file_exists($target);
    }
}