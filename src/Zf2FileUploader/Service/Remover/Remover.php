<?php
namespace Zf2FileUploader\Service\Remover;

use Zf2FileUploader\Entity\ResourceInterface;

class Remover implements RemoverInterface
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
     * @return Remover
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