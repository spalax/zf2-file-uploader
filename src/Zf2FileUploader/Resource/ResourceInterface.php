<?php
namespace Zf2FileUploader\Resource;

use Zf2FileUploader\Entity\Resource as ResourceEntity;

interface ResourceInterface extends ResourceRemovableInterface, ResourceViewableInterface
{
    /**
     * @return mixed
     */
    public function getToken();

    /**
     * @param mixed $token
     * @return ResourceInterface
     */
    public function setToken($id);

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

    /**
     * @return Resource
     */
    public function getEntity();

    /**
     * @param ResourceEntity $resourceEntity
     * @return ResourceInterface
     */
    public function setEntity(ResourceEntity $resourceEntity);
}