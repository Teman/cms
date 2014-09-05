<?php namespace Teman\Cms\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PackageGeneratorCommand extends Command {


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a package including a controller and a view based on an existing template';

    public function fire()
    {

        $name = $this->ask('What is the model name ? ');
        $pathController=app_path('/controllers');


        $ViewTemplatePartial =(__DIR__.'/../viewTemplate/ViewTemplateCreate.txt');

        $viewTemplateIndex=(__DIR__.'/../viewTemplate/ViewTemplateIndex.txt');
        $viewTemplateCreate=(__DIR__.'/../viewTemplate/ViewTemplateCreate.txt');
        $viewTemplateEdit=(__DIR__.'/../viewTemplate/ViewTemplateEdit.txt');
        $formTemplate=(__DIR__.'/../viewTemplate/FormTemplate.txt');
        $controllerTemlate=(__DIR__.'/../viewTemplate/ControllerTemplate.txt');



        //create the folder defined in the path
        $pathView =app_path('/views/'.$name);
        if (!file_exists($pathView)) {
            mkdir($pathView, 0775, true);
        }


        //create the partials folder defined in the path
        $formFolderPath = $pathView.'/partials';
        if (!file_exists($formFolderPath)) {
            mkdir($formFolderPath, 0775, true);
        }

        //generate the views based on a template
        $this->call('generate:view', array('--path' => $pathView,'--templatePath'=>$viewTemplateIndex,'viewName'=>'index'));
        $this->call('generate:view', array('--path' => $pathView,'--templatePath'=>$viewTemplateCreate,'viewName'=>'create'));
        $this->call('generate:view', array('--path' => $pathView,'--templatePath'=>$viewTemplateEdit,'viewName'=>'edit'));
        $this->call('generate:view', array('--path' => $formFolderPath,'--templatePath'=>$formTemplate,'viewName'=>'form'));

        //generate the controller
        $this->call('generate:controller',array('--path'=>$pathController,'--templatePath'=>$controllerTemlate,'controllerName'=>ucwords($name).'sController'));


        //replace the dummy variabels and titles to the correct name
        $this->str_replace_in_views($pathView.'/index.blade.php',array('VAR','TITLE'),array('$'.$name.'s',$name));
        $this->str_replace_in_views($pathView.'/create.blade.php',array('TITLE'),array($name));
        $this->str_replace_in_views($formFolderPath.'/form.blade.php',array('TITLE'),array($name));
        $this->str_replace_in_views($pathView.'/edit.blade.php',array('VAR','TITLE'),array('$'.$name,$name));
        $this->str_replace_in_views($pathController.'/'.ucwords($name).'sController.php',
            array('CLASSTITLE','INDEXDOC','INDEXVAR','INDEXTXT','INDEXTITLE',
                  'CREATEDOC','CREATETITLE',
                  'STOREDOC','STOREVAR','STORETITLE',
                  'SHOWDOC',
                  'EDITDOC','EDITVAR','EDITTITLE','EDITTXT',
                  'UPDATEDOC','UPDATEVAR','UPDATETITLE',
                  'DESTROYDOC','DESTROYVAR','DESTROYTITLE'

            ),
            array($name.'sController',$name.'s','$'.$name.'s',$name.'s',$name,
                  $name,$name,
                  $name,'$'.$name,$name,
                  $name,
                  $name,'$'.$name,$name,$name,
                  $name,'$'.$name,$name,
                  $name,'$name',$name
            ));

    }

    private function str_replace_in_views($viewPathFile,$OldKeyWords,$newKeyWords)
    {

        $path_to_file = $viewPathFile;
        $file_contents = file_get_contents($path_to_file);

        $maximumKeywords = sizeof($OldKeyWords);


        for($i=0 ; $i < $maximumKeywords ; $i++)
        {

            $file_contents = str_replace($OldKeyWords[$i],$newKeyWords[$i],$file_contents);

        }
        file_put_contents($path_to_file,$file_contents);

    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('example', InputArgument::OPTIONAL, 'An example argument.'),
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
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}