<?php
namespace Zf2FileUploader\Input\Resource\Scanner\Text;

use Zf2FileUploader\Resource\AbstractResource;

class Scanner implements ScannerInterface
{
    /**
     * @var string
     */
    protected $uniqueResourcePrefix;

    public function __construct($uniqueResourcePrefix = AbstractResource::UNIQUE_RESOURCE_PREFIX)
    {
        $this->uniqueResourcePrefix = $uniqueResourcePrefix;
    }

    /**
     * @param string $text
     * @return string[]
     */
    public function scan($text)
    {
        if (preg_match_all('/.*?(?P<tokens>'.preg_quote($this->uniqueResourcePrefix).'.*?)\./', $text, $matches)) {
            return $matches['tokens'];
        }

        return array();
    }
}