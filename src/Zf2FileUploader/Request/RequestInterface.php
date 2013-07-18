<?php

namespace Zf2FileUploader\Request;

interface RequestInterface extends ValidatorAwareInterface
{
    public function isValid();
}