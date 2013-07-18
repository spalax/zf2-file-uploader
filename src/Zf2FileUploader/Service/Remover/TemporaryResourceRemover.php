<?php
namespace Zf2FileUploader\Service\Remover;

class TemporaryResourceRemover extends Remover
{
    public function __construct(FilesystemRemover $fsRemover, DatabaseRemover $dbRemover)
    {
        parent::__construct(false);
        $this->addRemover($fsRemover)
             ->addRemover($dbRemover);
    }
}