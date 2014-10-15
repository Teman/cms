cms refactored
==============

### Installation

  1. Add a new folder into your desired directory
  1. Go to github.com/Bagaar/homestead
  1. Clone the repository in to your folder
  1. Navigate in the terminal to the directory and run vagrant up. This should create a Code folder in your directory
  1. Navigate with the terminal within the Code folder and run 'composer create-project laravel/laravel'
  1. Relocate the content of the laravel folder to Code
  1. Open the application and go to Composer.json
     - Here add at the bottom :  
          * repositories": [{"type": "composer","url": "http://composer.teman.be"}]
     - At the top in "require" add : 
          * "teman/cms"=>"dev-master"
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
2. Here you can see 1 big array named "adminMenuItems"
 - In this array you can place multiple arrays, for example for a section of users or a section of pages. Each having its own subcategories.
 - each "categorieItems" has 3 properties 
    * The first is : 'title', this is the text displayed in the menu
    * Second : 'permission',if you want restricted acces to a menu item you can give it a permission. 
    * Third : "adminMenuItems_subCategory", you can give each category multiple subcategories. Also being able to give it a permission, giving it the according route to the page, giving it the title wich displays on the menu and giving it the Iconclass(the icon before the word, FontAwesomme)
  
Here is an example of user with permission to the category and sub category. Below that you find a menu item with subItems that are open to everybody
````
 'adminMenuItems' => [
        [
            'title' => 'Users',
            'permission'=>'access_cms',
            'adminMenuItems_subCategory' => [
                [
                    'permission'=>'access_cms',
                    'route' => 'admin.users.index',
                    'title'=>'Users',
                    'iconClass'=>'fa fa-user',
                ],
            ],
        ],
        [
            'title' => 'Users',
            'adminMenuItems_subCategory' => [
                [
                    'route' => 'admin.users.index',
                    'title'=>'Users',
                    'iconClass'=>'fa fa-user',
                ],
            ],
        ],
````
    

====== 


### Adding/Using WYSIWYG textboxes (rich text)
1. Add class 'richtext' to textarea
2. Your laravel-friendly code should look something like this
````
    {{ Form::textarea('body', null, ['class' => 'form-control richtext']) }}

````

#### Configuration of rich text
You can use the following options for the textarea:
````coffee
$('#custom').wysihtml5
  toolbar:
    "font-styles": true #Font styling, e.g. h1, h2, etc. Default true
    "emphasis": true #Italics, bold, etc. Default true
    "lists": true #(Un)ordered lists, e.g. Bullets, Numbers. Default true
    "html": false #Button which allows you to edit the generated HTML. Default false
    "link": true #Button to insert a link. Default true
    "image": true #Button to insert an image. Default true,
    "color": false #Button to change color of font  
    "blockquote": true #Blockquote  
    "size": <buttonsize> #default: none, other options are xs, sm, lg
````