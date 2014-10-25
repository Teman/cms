<?php
namespace Teman\Cms\Translations;

use Polyglot\Services\Lang;

class Translator extends Lang
{

    /**
     * Get the translation for the given key, or fallback to fallback locale
     *
     * @param  string $key
     * @param  array  $replace
     * @param  string $locale
     *
     * @return string
     */
    public function get($key, array $replace = array(), $locale = null)
    {
        //do own stuff

        //else?

        return parent::get($key, $replace, $locale);

    }

}