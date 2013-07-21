<?php
namespace Zf2FileUploader\I18n\Translator;

interface TranslatorInterface
{
    /**
     * @param string $message
     * @param string $textDomain
     * @param null $locale
     * @return string
     */
    public function translate($message, $textDomain = 'default', $locale = null);
}