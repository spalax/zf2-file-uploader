<?php
namespace Zf2FileUploader\Resource;

use Zf2FileUploader\Entity\Resource as ResourceEntity;

class Resource implements ResourceInterface
{
    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $ext = '';

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var ResourceEntity | null
     */
    protected $resourceEntity = null;

    /**
     * @param string $path
     */
    public function __construct($path, $ext, $id = null)
    {
        $this->id = is_null($id) ? uniqid(md5($path)) : $id;
        $this->ext = $ext;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $id
     * @return Resource
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $path
     * @return Resource
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $ext
     * @return Resource
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }

    /**
     * @return string
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @return ResourceEntity
     */
    public function getEntity()
    {
        return $this->resourceEntity;
    }

    /**
     * @param ResourceEntity $entity
     * @return Resource
     */
    public function setEntity(ResourceEntity $entity)
    {
        $this->resourceEntity = $entity;
        return $this;
    }
}