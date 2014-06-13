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
     * @var string
     */
    protected $imageHttpPath = '';

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
    protected $imagePersistentPath = '';

    /**
     * @var string
     */
    protected $fileInputName = 'file';

    /**
     * @var bool
     */
    protected $enableDefaultEntities = true;

    /**
     * @var string | null
     */
    protected $translator = null;

    /**
     * @param string $imageHttpPath
     */
    public function setImageHttpPath($imageHttpPath)
    {
        $this->imageHttpPath = $imageHttpPath;
    }

    /**
     * @return string
     */
    public function getImageHttpPath()
    {
        return $this->imageHttpPath;
    }

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
     * @param string $imagePersistentPath
     * @throws InvalidArgumentException
     */
    public function setImagePersistentPath($imagePersistentPath)
    {
        $imagePersistentPath = realpath($imagePersistentPath);
        if (!is_dir($imagePersistentPath) || !is_writable($imagePersistentPath)) {
            throw new InvalidArgumentException("Image persistent path $imagePersistentPath is unreachable");
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
     * @param boolean $enableDefaultEntities
     */
    public function setEnableDefaultEntities($enableDefaultEntities)
    {
        $this->enableDefaultEntities = $enableDefaultEntities;
    }

    /**
     * @return boolean
     */
    public function getEnableDefaultEntities()
    {
        return $this->enableDefaultEntities;
    }
}
