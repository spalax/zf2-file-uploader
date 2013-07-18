<?php
namespace Zf2FileUploader\Entity;

interface ImageInterface
{
    public function getId();
    public function getAlt();

    public function setAlt($alt);
}