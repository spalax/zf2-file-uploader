<?php
namespace Zf2FileUploader\Entity;

use Zf2FileUploader\Resource\ResourceRemovableInterface;

interface ResourceInterface extends ResourceRemovableInterface
{
    /**
     * @param string $path
     * @return ResourceInterface
     */
    public function setPath($path);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $token
     * @return ResourceInterface
     */
    public function setToken($token);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @param boolean $temporary
     * @return mixed
     */
    public function setTemporary($temporary);

    /**
     * @return ResourceInterface
     */
    public function getTemporary();

    /**
     * @param \DateTime $createdTimestamp
     * @return ResourceInterface
     */
    public function setCreatedTimestamp($createdTimestamp);

    /**
     * @return \DateTime
     */
    public function getCreatedTimestamp();
}