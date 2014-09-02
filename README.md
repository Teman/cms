cms
===

### Installation

<ul>
  <li>Step 1 : Add a new folder into your desired directory</li>
  <li>Step 2 : Go to www.github.com/Bagaar/homestead</li>
  <li>Step 3 : Clone the repository in to your folder</li>
  <li>Step 4 : Navigate in the terminal to the directory and run vagrant up. This should create a Code folder in your directory</li>
  <li>Step 5 : Navigate with the terminal within the Code folder and run 'composer create-project laravel/laravel'</li>
  <li>Step 6 : Relocate the content of the laravel folder to Code</li>
  <li>Step 7 : Open the application and go to Composer.json</li>
  <ul>
    <li>Here add at the bottom :  
        "repositories": [
            {
                "type": "composer",
                "url": "http://composer.teman.be"
            }
        ]
  </li>
  
  <li>At the top in "require" add : "teman/cms"=>"dev-master"</li>
  </ul>
  <li>Step 8 : Open the app.php file </li>
  <ul>
    <li>add to 'providers' : 'Teman\Cms\CmsServiceProvider'</li>
  </ul>

<li>Step 9 : In the terminal execute the command : 'composer update'</li>
  <ul>
  <li>Now if you run php artisan, you should see 'cms:install' and 'cms:package'</li>
  </ul>
  
<li>Step 10 : In the terminal execute the command : 'php artisan cms:install' and follow the terminal </li>
<li>Step 11 : Browse to 127.0.0.1:8000/admin and login with the credentials you made during the install</li>
</ul>

###### Installation is complete
======

### Creating a view with controller
<ul>
  <li>In the terminal enter 'php artisan cms:package'</li>
  <li>Enter the desired name</li>
  <li>If you check your project you will see that in views it created a folder with your given name</li>
    <ul>
      <li>Here you will find a index/create/edit page</li>
      <li>If you open the pages you will see that there already is a lot of template code, modify the code to your        needs</li>
    </ul>
    <li>Next to the views there will be a controller created in 'Controllers' this should have the name : "name"Controller</li>
    <ul>
      <li>Again there is a lot of template code, there will be places where the code is in comment or ot sais "ADDHERE". Make sure you fill them in according to your model and needs</li>
    </ul>
</ul>
###### To edit this code you can go to : "vendor/teman/cms/src/Teman/Cms/Commands/PackageGeneratorCommand.php
======


### Adding items to the sidebar
<ul>
  <li> </li>
</ul>






