<?php
namespace Zf2FileUploader\Validator;

use Zend\Validator\AbstractValidator;
use Zend\I18n\Validator\Alnum as AlnumValidator;
use Zend\Validator\Exception;

class TokenFormatValidator extends AbstractValidator
{
    const INVALID        = 'tokenInvalidFormat';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::INVALID        => "Invalid token format given."
    );

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param mixed $tokens
     * @return bool
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
        if (!strpos($token, '_')) {
            $this->error(self::INVALID);
            return false;
        }

        $validator = new AlnumValidator();

        $tokenParts = explode('_', $token);

        if (!$validator->isValid($tokenParts[0]) ||
            !$validator->isValid($tokenParts[1])) {
            $this->error(self::INVALID);
            return false;
        }

        return true;
    }
}
