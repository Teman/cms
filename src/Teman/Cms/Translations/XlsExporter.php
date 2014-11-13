<?php
namespace Teman\Cms\Translations;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Teman\Cms\Models\Translation;

class XlsExporter
{

    private $translations = [];
    private $locales = [];


    private function collectData()
    {
        $translations = Translation::orderBy('group', 'asc')->orderBy('key', 'asc')->get();
        foreach( $translations as $translation ){
            if ( ! in_array($translation->locale, $this->locales) ){
                $this->locales[] = $translation->locale;
            }
            $this->translations[ $translation->group . '.' . $translation->key ][ $translation->locale ] = $translation->value;
        }
    }


    public function getTableView()
    {
        $this->collectData();

        return View::make('cms::xls.translations')->with([
                'locales' => $this->locales,
                'translations' => $this->translations
            ]);
    }

    public function downloadXls()
    {
        $this->collectData();

        $locales = $this->locales;
        $translations = $this->translations;

        \Excel::create('translation-export', function($excel) use( $locales, $translations ) {
            $excel->sheet('Translations', function($sheet) use( $locales, $translations ) {
                    $sheet->loadView('cms::xls.translations', [
                            'locales' => $locales,
                            'translations' => $translations
                        ]);
                });
        })->download();
    }
}