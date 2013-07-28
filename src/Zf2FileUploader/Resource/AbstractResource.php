<?php
namespace Zf2FileUploader\Resource;

abstract class AbstractResource implements ResourceInterface
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
    protected $token = '';

    /**
     * @param string $path
     * @param string $ext
     * @param string | null $token
     */
    public function __construct($path, $ext, $token = null)
    {
        $this->token = is_null($token) ? uniqid(md5($path)) : $token;
        $this->ext = $ext;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Resource
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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
}