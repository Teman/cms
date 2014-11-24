<?php
namespace Teman\Cms\Translations;

use Teman\Cms\Models\Translation;

class XlsImporter
{


    public function importXls($file)
    {
        $response = (object)[
            'updated' => 0,
            'ignored' => 0
        ];

        \Excel::load($file, function($reader) use ($response) {

                // reader methods
                $results = $reader->all();

                foreach( $results as $result ){

                    $key = $result->key;
                    $keyA = explode('.', $key);
                    $group = array_shift($keyA);
                    $key = implode('.', $keyA);

                    foreach( $result->keys() as $locale ){
                        if ( $locale != 'key' ){
                            $value = $result->{$locale};

                            if ( $value ){

                                //find translation in db
                                $translation = Translation::where('locale', $locale)->where('group', $group)->where('key', $key)->first();
                                //update
                                if ( $translation ){
                                    $translation->value = $value;
                                    $translation->status = 1;
                                    $translation->save();

                                    $response->updated++;
                                } else {
                                    $response->ignored++;
                                }

                                //no insert

                            } else {
                                $response->ignored++;
                            }

                        } else {
                            $response->ignored++;
                        }
                    }

                }

            });

        return $response;

    }


}