<?php

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
    protected $name = 'generate:package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a package including a controller and a view based on an existing template';

    public function fire()
    {
        $name = $this->ask('What is the model name ? ');


        $pathView =app_path(__DIR__ . '../../../views/'.$name);
        $viewTemplate=app_path(__DIR__.'../viewTemplate/view.txt');

        $pathController=app_path(__DIR__.'../Controllers/');


        //create the folder defined in the path
        if (!file_exists($pathView)) {
            mkdir($pathView, 0775, true);
        }

        //generate the views based on a template
        $this->call('generate:view', array('--path' => $pathView,'--templatePath'=>$viewTemplate,'viewName'=>'index'));
        $this->call('generate:view', array('--path' => $pathView,'--templatePath'=>$viewTemplate,'viewName'=>'show'));
        $this->call('generate:view', array('--path' => $pathView,'--templatePath'=>$viewTemplate,'viewName'=>'create'));

        //generate the controller
        $this->call('generate:controller',array('--path'=>$pathController,'controllerName'=>$name.'sController'));


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
