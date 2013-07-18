<?php
namespace Zf2FileUploader\Service\Persister;

interface PersisterInterface
{
    public function persist();

    public function revert();

    public function flush();
}