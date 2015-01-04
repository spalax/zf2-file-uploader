<?php
namespace Zf2FileUploader\Resource\AbstractFactory;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface PersistedResourceInterface
{
    /**
     * @param string $token
     * @return ImageResourceInterface | null
     */
    public function loadImageResource($token);
}
