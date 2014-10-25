<?php
namespace Teman\Cms\Translations;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\URL;
use Polyglot\Services\Lang;
use Teman\Cms\Models\Translation;

class Translator extends Lang
{

    private $db_keys = [];
    private $db_keys_loaded = false;

    public function __construct(Container $app)
    {
        parent::__construct($app);

    }

    private function loadDbKeys()
    {
        $translations = Translation::all();
        foreach( $translations as $translation ){
            $this->db_keys[ $translation->locale ][ $translation->group . '.' . $translation->key ] = $translation->value;
        }

        $this->db_keys_loaded = true;
    }

    /**
     * Get the translation for the given key
     *
     * @param  string $key
     * @param  array  $replace
     * @param  string $locale
     *
     * @return string
     */
    public function get($key, array $replace = array(), $locale = null)
    {
        if ( ! $this->db_keys_loaded ) $this->loadDbKeys();

        if ( is_null($locale) ) $locale = URL::locale();
        if ( is_null($locale) ) $locale = $this->fallbackLocale();

        if ( isset( $this->db_keys[$locale][$key] ) ){
            return $this->makeReplacements($this->db_keys[$locale][$key], $replace);
        }

        return parent::get($key, $replace, $locale);
    }

}