cms
===

### Installation


  1. Add a new folder into your desired directory
  1. Go to www.github.com/Bagaar/homestead
  1. Clone the repository in to your folder
  1. Navigate in the terminal to the directory and run vagrant up. This should create a Code folder in your directory
  1. Navigate with the terminal within the Code folder and run 'composer create-project laravel/laravel'
  1. Relocate the content of the laravel folder to Code
  1. Open the application and go to Composer.json
     - Here add at the bottom :  
          *repositories": [{"type": "composer","url": "http://composer.teman.be"}]
     - At the top in "require" add : 
          *"teman/cms"=>"dev-master"
  8. Open the app.php file 
    - add to 'providers' : 
     *'Teman\Cms\CmsServiceProvider'
  9. In the terminal execute the command : 'composer update'
  10. Now if you run php artisan, you should see 'cms:install' and 'cms:package'
  11. In the terminal execute the command : 'php artisan cms:install' and follow the terminal 
  12. Browse to 127.0.0.1:8000/admin and login with the credentials you made during the install


###### Installation is complete
======

### Creating a view with controller

  1. In the terminal enter 'php artisan cms:package'
  1. Enter the desired name
  1. If you check your project you will see that in views it created a folder with your given name
      - Here you will find a index/create/edit page
         * If you open the pages you will see that there already is a lot of template code, modify the code to your needs
      - Next to the views there will be a controller created in 'Controllers' this should have the name : "name"Controller
         * Again there is a lot of template code, there will be places where the code is in comment or ot sais "ADDHERE". Make sure you fill them in according to your model and needs

###### To edit this code you can go to : "vendor/teman/cms/src/Teman/Cms/Commands/PackageGeneratorCommand.php
======


### Adding items to the sidebar
1. Go to Code/app/config/packages/teman/cms/config.php
2. Here you can see 1 big array named "categorieItems"
 - In this array you can place multiple arrays, for example for a section of users or a section of pages. Each having its own subcategories.
 - each "categorieItems" has 3 properties 
    * The first is : 'title', this is the text displayed in the menu
    * Second : 'permission', you can give it a level of permission in order to view the menu item
    * Third : "subCategorieItems", you can give each category multiple subcategories. Also being able to give it a permission, giving it the according route to the page, giving it the itemText wich displays on the menu and giving it the Iclass(the icon before the word, FontAwesomme)
    

====== 


### Adding/Using the Richtextbox Editor
#### Adding a richTextbox to your view 
1. First of all open a form (and close it)
2. Inside the form put : @include('cms::sandbox.partials.richTextBoxEditor',array('txtbxName'=>'Simple'))
  - this will add the partial to your view. The second argument is the definition of your configuration (Simple,        Basic or Advanced). We will come back to that later
3. Your code should look something like this
````
    {{ Form::open(['method'=>'post','route' => 'admin.textbox.store']) }}

        @include('cms::sandbox.partials.richTextBoxEditor',array('txtbxName' => 'Simple'))


        </br>
        </br>

        @include('cms::sandbox.partials.datePicker')

        @include('cms::sandbox.partials.submit')
    {{Form::close()}}

````
#### Configuration of your own RTE
1. Every RTE links to a configuration file, at this moment there are 3. Located in : 'public/teman/cms/js/richTextBoxConfigs'
  - in this file you will find config.toolbar array. In this array there are multiple other arrays representing a   group of items.
  - You can add as many of the existing items as you want and devide them into your own groups
1. You can also make a new config file. To link it to your RTE do the following :
  - open list.js. Located in : 'public/teman/cms/js'
  - Scroll down to this piece of code :
````
        var richtextboxes = $('.richTextBoxEditor');
        richtextboxes.each( function(){
        var textbox = $(this);
        console.log(textbox);
        var type = textbox.data('editor-template');

        if ( ! type || type == 'Simple' ){
            CKEDITOR.replace('richTextBoxEditorSimple',{
                customConfig: 'richTextBoxConfigs/ckeditor_custom_configSimple.js'
            });
        }

        if ( type == 'Basic' ){
            CKEDITOR.replace('richTextBoxEditorBasic' ,{
                customConfig: 'richTextBoxConfigs/ckeditor_custom_configBasic.js'
            });
        }
        if ( type == 'Advanced' ){
            CKEDITOR.replace('richTextBoxEditorAdvanced' ,{
                customConfig: 'richTextBoxConfigs/ckeditor_custom_configAdvanced.js'
            });
        }

    });
````
   
   
    - Here add another if statement and fill in the correct names and paths       
    
    
## Using a dateTimePicker
1. There is a template for a datetimepicker located in the "cms::sandbox.partials.datePicker.php"
2. To use it in your view add (between form tags) : @include('cms::sandbox.partials.datePicker')
  - To give the datePicker a default date (maybe refering to when the user was created) the share with the view(trough the controller) the variabel $date, it will then automaticly set the date.

       

    








