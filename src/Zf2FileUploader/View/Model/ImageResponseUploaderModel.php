<?php
namespace Zf2FileUploader\View\Model;

use Zf2FileUploader\Service\Response\ImageResponseInterface;
use Zf2FileUploader\View\Model\Exception\InvalidArgumentException;

class ImageResponseUploaderModel extends AbstractResponseUploaderModel
{
    /**
     * @param array $responses
     * @throws InvalidArgumentException
     */
    public function __construct(array $responses)
    {
        foreach ($responses as $response) {
            if (!$response instanceof ImageResponseInterface) {
                throw new InvalidArgumentException('Response must be type of ImageResponseInterface');
            }

            if (!$this->checkSuccess($response)) {
                return;
            }

            $this->addResource($response->getResource());
        }

        $this->setVariable('status', static::STATUS_SUCCESS);
        $this->setMessages($responses);
    }
}
