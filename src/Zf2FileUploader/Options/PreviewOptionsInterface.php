<?php
namespace Zf2FileUploader\Options;

interface PreviewOptionsInterface
{
    /**
     * @return int
     */
    public function getDefaultPreviewHeight();

    /**
     * @return int
     */
    public function getDefaultPreviewWidth();
}
