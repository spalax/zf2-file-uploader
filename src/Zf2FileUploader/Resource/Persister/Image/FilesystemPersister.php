<?php
namespace Zf2FileUploader\Resource\Persister\Image;

use Zend\Filter\File\Rename;
use Zf2FileUploader\Options\ImagePersisterOptionsInterface;
use Zf2FileUploader\Resource\Persister\AbstractFilesystemPersister;
use Zf2FileUploader\Resource\ResourceInterface;

class FilesystemPersister extends AbstractFilesystemPersister
{
    /**
     * @var ImagePersisterOptionsInterface
     */
    protected $options;

    public function __construct(ImagePersisterOptionsInterface $options)
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
        $target = realpath($this->options->getImagePersistentPath()).'/'.uniqid().($ext ? '.'.$ext : '');

        $moveUploadedFilter = new Rename(array(
            'target'               => $target,
            'overwrite'            => false,
            'randomize'            => false,
        ));

        $oldPath = $resource->getPath();
        $moveUploadedFilter->filter($resource->getPath());

        $resource->setPath($target);

        $this->setCallbacks(null, function () use ($resource, $target, $oldPath) {
            if (file_exists($target)) {
                $moveUploadedFilter = new Rename(array(
                    'target'               => $oldPath,
                    'overwrite'            => false,
                    'randomize'            => false,
                ));
                $moveUploadedFilter->filter($target);
            }
            $resource->setPath($oldPath);
        });

        return file_exists($target);
    }
}