<?php
namespace Zf2FileUploader\Options;

use Zf2FileUploader\Options\Exception\InvalidArgumentException;
use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * @var int
     */
    protected $ttl = 4;

    /**
     * @var string
     */
    protected $imageEntityClass = 'Zf2FileUploader\Entity\Image';

    /**
     * @var int
     */
    protected $defaultPreviewHeight = 200;

    /**
     * @var int
     */
    protected $defaultPreviewWidth = 200;

    /**
     * @var bool
     */
    protected $useQueryPreviewImageSize = true;

    /**
     * @var string
     */
    protected $persistentPath = '';

    /**
     * @var string
     */
    protected $imagePersistentPath = '';

    /**
     * @var string
     */
    protected $fileInputName = 'file';

    /**
     * @var string | null
     */
    protected $translator = null;

    /**
     * @param string $translator
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return string
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @param string $fileInputName
     */
    public function setFileInputName($fileInputName)
    {
        $this->fileInputName = $fileInputName;
    }

    /**
     * @return string
     */
    public function getFileInputName()
    {
        return $this->fileInputName;
    }

    /**
     * @param string $persistentPath
     * @throws Exception\InvalidArgumentException
     */
    public function setPersistentPath($persistentPath)
    {
        $persistentPath = realpath($persistentPath);
        if (!is_dir($persistentPath) || !is_writable($persistentPath)) {
            throw new InvalidArgumentException("Persistent path $persistentPath is unreachable");
        }
        $this->persistentPath = $persistentPath;
    }

    /**
     * @return string
     */
    public function getPersistentPath()
    {
        return $this->persistentPath;
    }

    /**
     * @param string $imagePersistentPath
     */
    public function setImagePersistentPath($imagePersistentPath)
    {
        $imagePersistentPath = realpath($imagePersistentPath);
        if (!is_dir($imagePersistentPath) || !is_writable($imagePersistentPath)) {
            throw new InvalidArgumentException("Persistent path $imagePersistentPath is unreachable");
        }
        $this->imagePersistentPath = $imagePersistentPath;
    }

    /**
     * @return string
     */
    public function getImagePersistentPath()
    {
        return $this->imagePersistentPath;
    }

    /**
     * @param int $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = intval($ttl);
    }

    /**
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param string $imageEntityClass
     */
    public function setImageEntityClass($imageEntityClass)
    {
        $this->imageEntityClass = $imageEntityClass;
    }

    /**
     * @return string
     */
    public function getImageEntityClass()
    {
        return $this->imageEntityClass;
    }

    /**
     * @param int $defaultPreviewHeight
     */
    public function setDefaultPreviewHeight($defaultPreviewHeight)
    {
        $this->defaultPreviewHeight = $defaultPreviewHeight;
    }

    /**
     * @return int
     */
    public function getDefaultPreviewHeight()
    {
        return $this->defaultPreviewHeight;
    }

    /**
     * @param int $defaultPreviewWidth
     */
    public function setDefaultPreviewWidth($defaultPreviewWidth)
    {
        $this->defaultPreviewWidth = $defaultPreviewWidth;
    }

    /**
     * @return int
     */
    public function getDefaultPreviewWidth()
    {
        return $this->defaultPreviewWidth;
    }

    /**
     * @param boolean $useQueryPreviewImageSize
     */
    public function setUseQueryPreviewImageSize($useQueryPreviewImageSize)
    {
        $this->useQueryPreviewImageSize = $useQueryPreviewImageSize;
    }

    /**
     * @return boolean
     */
    public function getUseQueryPreviewImageSize()
    {
        return $this->useQueryPreviewImageSize;
    }
}
