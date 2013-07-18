<?php
namespace Zf2FileUploader\Options;

interface TemporaryCleanerOptionsInterface
{
    /**
     * Time to leave in seconds,
     * when temporary resource will
     * be removed.
     *
     * @return int
     */
    public function getTtl();
}
