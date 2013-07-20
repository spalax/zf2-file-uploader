<?php
namespace Zf2FileUploader\Resource\Remover;

use Zf2FileUploader\Resource\ResourceInterface;

class AggregateRemover implements RemoverInterface
{
    /**
     * @var RemoverInterface[]
     */
    protected $removers = array();

    /**
     * @var bool
     */
    protected $stopIfOneFail = false;

    /**
     * @param bool $stopIfOneFail
     */
    public function __construct($stopIfOneFail = false)
    {
        $this->stopIfOneFail = $stopIfOneFail;
    }

    /**
     * @param RemoverInterface $remover
     * @return AggregateRemover
     */
    public function addRemover(RemoverInterface $remover)
    {
        $this->removers[] = $remover;
        return $this;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function remove(ResourceInterface $resource)
    {
        $return = false;
        foreach ($this->removers as $remover) {
            $res = $remover->remove($resource);
            if ($this->stopIfOneFail === true && !$res) {
                return false;
            } else if ($res && !$return) {
                $return = true;
            }
        }

        return $return;
    }
}