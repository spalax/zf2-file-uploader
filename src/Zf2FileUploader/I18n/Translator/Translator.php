<?php
namespace Zf2FileUploader\I18n\Translator;

use Zend\I18n\Translator\Translator as TargetTranslator;

class Translator implements TranslatorInterface
{
    /**
     * @var null | Translator
     */
    protected $translator = null;

    public function __construct(TargetTranslator $translator = null)
    {
        $this->translator = $translator;
    }

    /**
     * @param string $message
     * @param string $textDomain
     * @param null $locale
     * @return string
     */
    public function translate($message, $textDomain = 'default', $locale = null)
    {
        if (is_null($this->translator)) {
            return $message;
        }

        return $this->translator->translate($message, $textDomain, $locale);
    }
}