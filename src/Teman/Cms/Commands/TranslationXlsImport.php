<?php namespace Teman\Cms\Commands;


use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Teman\Cms\Translations\XlsImporter;

class TranslationXlsImport extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'translations:xlsimport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import translations from xls file';
    /**
     * @var \Teman\Cms\Translations\XlsImporter
     */
    private $xlsImporter;


    public function __construct( XlsImporter $xlsImporter )
    {
        parent::__construct();
        $this->xlsImporter = $xlsImporter;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $file = $this->argument('file');

        $this->comment('Importing file ' . $file);

        $response = $this->xlsImporter->importXls($file);

        $this->info('updated ' . $response->updated);
        $this->info('ignored ' . $response->ignored);

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('file', InputArgument::REQUIRED, 'xls file to import.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            //array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}
