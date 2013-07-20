<?php
namespace Zf2FileUploader\Resource;

class Resource implements ResourceInterface
{
    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @param string $path
     */
    public function __construct($path, $id = null)
    {
        $this->id = is_null($id) ? uniqid(md5($path)) : $id;
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
}