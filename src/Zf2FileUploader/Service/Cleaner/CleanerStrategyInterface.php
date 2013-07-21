<?php
namespace Zf2FileUploader\Service\Cleaner;


interface CleanerStrategyInterface
{
    /**
     * @return bool
     */
    public function clean();
}