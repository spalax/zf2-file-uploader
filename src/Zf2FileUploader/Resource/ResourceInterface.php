<?php
namespace Zf2FileUploader\Resource;

interface ResourceInterface extends ResourceRemovableInterface
{
    /**
     * @return mixed
     */
    public function getToken();

    /**
     * @param mixed $token
     * @return ResourceInterface
     */
    public function setToken($token);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $path
     * @return ResourceInterface
     */
    public function setPath($path);

    /**
     * @return string
     */
    public function getExt();

    /**
     * @param string $ext
     * @return ResourceInterface
     */
    public function setExt($ext);
}