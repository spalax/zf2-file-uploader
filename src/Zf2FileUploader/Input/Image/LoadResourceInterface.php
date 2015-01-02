<?php
namespace Zf2FileUploader\Input\Image;

use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;

interface LoadResourceInterface
{
    /**
     * @return ImageResourceInterface[]
     */
    public function getResources();

    /**
     * @param bool $allowEmpty
     * @return LoadResourceInterface
     */
    public function setAllowEmpty($allowEmpty);

    /**
     * @param bool $required
     * @return LoadResourceInterface
     */
    public function setRequired($required);
}
