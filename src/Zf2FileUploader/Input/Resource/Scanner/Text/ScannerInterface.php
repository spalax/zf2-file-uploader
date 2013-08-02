<?php
namespace Zf2FileUploader\Input\Resource\Scanner\Text;

interface ScannerInterface
{
    /**
     * @param string $text
     * @return string[]
     */
    public function scan($text);
}