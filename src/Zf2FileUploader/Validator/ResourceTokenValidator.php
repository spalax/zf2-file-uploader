<?php
namespace Zf2FileUploader\Validator;

use Doctrine\ORM\EntityRepository;
use Zend\I18n\Filter\Alnum as AlnumFilter;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class ResourceTokenValidator extends AbstractValidator
{
    const INVALID        = 'tokenInvalid';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::INVALID        => "Invalid token given."
    );

    /**
     * @var EntityRepository
     */
    protected $repository;

    public function __construct(EntityRepository $repository, $options = null)
    {
        $this->repository = $repository;

        parent::__construct($options);
    }

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     * @return bool
     * @throws Exception\RuntimeException If validation of $value is impossible
     */
    public function isValid($tokens)
    {
        if (is_array($tokens)) {
            foreach ($tokens as $token) {
                if (!$this->validate($token)) {
                    return false;
                }
            }
        } else {
            return $this->validate($tokens);
        }
        return true;
    }

    /**
     * @param string $token
     * @return bool
     */
    protected function validate($token)
    {
        $filter = new AlnumFilter();
        $qb = $this->repository->createQueryBuilder('r');
        $qb->select('1')
           ->where('r.token = :t');

        $token = $filter->filter($token);
        $qb->setParameter('t', $token);
        if (!count($qb->getQuery()->getResult())) {
            $this->error(self::INVALID);
            return false;
        }

        return true;
    }
}