<?php
namespace Zf2FileUploader\Input\Image\LoadResource;

use Zend\InputFilter\Input;
use Zend\Validator\Callback;
use Zend\Validator\File\MimeType;
use Zf2FileUploader\Input\Image\LoadResourceInterface;
use Zf2FileUploader\Input\Resource\Scanner\Text\Scanner;
use Zf2FileUploader\Input\Resource\Scanner\Text\ScannerInterface;
use Zf2FileUploader\Resource\AbstractFactory\PersistedResourceInterface as AbstractResourceFactory;
use Zf2FileUploader\Resource\ImageResource;
use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;
use Zf2FileUploader\Validator\ResourceTokenValidator;

class FromText extends Input implements LoadResourceInterface
{

    /**
     * @var bool
     */
    protected $isValid = false;

    /**
     * @var AbstractResourceFactory
     */
    protected $abstractResourceFactory;

    /**
     * @var ImageResourceInterface[]
     */
    protected $resources = array();

    /**
     * @var ScannerInterface
     */
    protected $scanner;

    /**
     * @param string $name
     * @param AbstractResourceFactory $resourceFactory
     */
    public function __construct($name = 'content',
                                AbstractResourceFactory $resourceFactory)
    {
        $this->scanner = new Scanner(ImageResource::UNIQUE_RESOURCE_PREFIX);
        parent::__construct($name);
    }

    /**
     * @param null $context
     * @return bool
     */
    public function isValid($context = null)
    {
        $this->isValid = parent::isValid($context);
        return $this->isValid;
    }

    /**
     * @return ImageResourceInterface[]
     */
    public function getResources()
    {
        $resources = array();

        if ($this->isValid) {

            $value = parent::getValue();

            if (is_array($value)) {
                $values = $value;
            } else {
                $values = array($value);
            }

            foreach($values as $value) {
                $tokens = $this->scanner->scan($value);

                foreach ($tokens as $token) {
                    $resources[] = $this->abstractResourceFactory->loadImageResource($token);
                }
            }
        }

        return $resources;
    }
}