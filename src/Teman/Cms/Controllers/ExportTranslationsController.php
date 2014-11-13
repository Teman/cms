<?php
namespace Teman\Cms\Controllers;


use Teman\Cms\Translations\XlsExporter;

class ExportTranslationsController extends AdminController
{

    /**
     * @var \Teman\Cms\Translations\XlsExporter
     */
    private $xlsExporter;

    function __construct( XlsExporter $xlsExporter )
    {

        $this->xlsExporter = $xlsExporter;
    }


    public function index()
    {
        $this->xlsExporter->downloadXls();
        //return $this->xlsExporter->getTableView();
    }

}