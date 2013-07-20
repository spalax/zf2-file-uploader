<?php
namespace Zf2FileUploader\Service\Resource;

use Zf2FileUploader\Resource\Handler\HandlerInterface;
use Zf2FileUploader\Resource\Persister\PersisterInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\Service\Resource\Response\Response;
use Zf2FileUploader\Service\Resource\Response\ResponseInterface;

class SaveService
{
    /**
     * @var PersisterInterface
     */
    protected $persister;

    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @param PersisterInterface $persister
     * @param HandlerInterface $handler
     */
    public function __construct(PersisterInterface $persister,
                                HandlerInterface $handler)
    {
        $this->persister = $persister;
        $this->handler = $handler;
    }

    /**
     * @param ResourceInterface $resource
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function save(ResourceInterface $resource, ResponseInterface $response = null)
    {
        if (is_null($response)) {
            $response = new Response($resource);
        }

        $this->persister->persist($resource);
        return $response;
    }

    /**
     * @param ResourceInterface[] $resources
     * @return ResponseInterface[]
     */
    public function saveCollection(array $resources)
    {
        $responses = array();

        foreach ($resources as $resource) {
            $responses[] = $this->save($resource);
        }

        return $responses;
    }
}
