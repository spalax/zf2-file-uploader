<?php
namespace Zf2FileUploader\Service;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface as ImagineImageInterface;
use Zend\Filter\File\Rename;
use Imagine\Gd\Imagine;
use Front\Filter\ExtensionAppender;
use Front\Data\Upload\ImageInterface;

class ImageCreate implements ImageSaveInterface
{
    /* (non-PHPdoc)
     * @see \Front\Service\Preview\Upload\ImageSaveInterface::save()
     */
    public function save( $uploadData)
    {
        $imagine = new Imagine();

        $filter = new ExtensionAppender($uploadData->getTargetExtension());
        $renameFilter = new Rename(array('source'=>$uploadData->getFullPath(),
                                         'target'=>$filter->filter($uploadData->getFullPath()),
                                         'overwrite'=>true
                     ));

        $newFile = $renameFilter->filter($uploadData->getFullPath());

        $image = $imagine->open($newFile);

        $sizeBox = null;

        $sizeBox = new Box($uploadData->getResizeWidth(), $uploadData->getResizeHeight());
        $mode = ImagineImageInterface::THUMBNAIL_OUTBOUND;

        if (!is_null($sizeBox)) {
            $image->thumbnail($sizeBox, $mode)
                  ->save($newFile, array('format'=>'jpg'));
        }

        return basename($newFile);
    }
}
