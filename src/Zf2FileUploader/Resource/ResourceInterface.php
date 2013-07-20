<?php
namespace Zf2FileUploader\Resource;

interface ResourceInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param mixed $id
     * @return ResourceInterface
     */
    public function setId($id);

    /**
     * @param string $path
     * @return ResourceInterface
     */
    public function setPath($path);
}