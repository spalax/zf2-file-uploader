<?php
namespace Zf2FileUploader\Input\Image\LoadResource;

use Doctrine\ORM\EntityManager;
use Zend\InputFilter\Input;
use Zend\Validator\Callback;
use Zend\Validator\File\MimeType;
use Zf2FileUploader\Input\Image\LoadResourceInterface;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Resource\AbstractFactory\PersistedResourceInterface as AbstractResourceFactory;
use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;
use Zf2FileUploader\Validator\ResourceTokenValidator;

class FromList extends Input implements LoadResourceInterface
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
     * @param string $name
     * @param AbstractResourceFactory $resourceFactory
     */
    public function __construct($name = 'image',
                                AbstractResourceFactory $resourceFactory,
                                EntityManager $entityManager,
                                ImageResourceOptionsInterface $imageOptions)
    {
        parent::__construct($name);

        $this->abstractResourceFactory = $resourceFactory;
        $validator = new ResourceTokenValidator($entityManager->getRepository($imageOptions->getImageEntityClass()));

        $this->getValidatorChain()->attach($validator);
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

            $tokens = parent::getValue();

            if (is_array($tokens)) {
                foreach ($tokens as $token) {
                    $resources[] = $this->abstractResourceFactory->loadImageResource($token);
                }
            } else {
                $resources[] = $this->abstractResourceFactory->loadImageResource($tokens);
            }
        }

        return $resources;
    }
}