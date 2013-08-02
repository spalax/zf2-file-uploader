<?php
namespace Zf2FileUploader\Stdlib\Extractor\Paginator;

use Zend\Stdlib\Hydrator\HydratorInterface;
use Zf2FileUploader\Entity\ImageInterface;
use Front\Stdlib\Extractor\Exception\InvalidArgumentException;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;

class ImageExtractor implements ExtractorInterface
{
    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    public function __construct(HydratorInterface $objectHydrator)
    {
        $this->hydrator = $objectHydrator;
    }

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof ImageInterface) {
            throw new InvalidArgumentException("Invalid object must be instance of ImageInterface");
        }

        return $this->hydrator->extract($object);
    }
}