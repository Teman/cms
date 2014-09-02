cms
===

<h3>installation</h3>

<ul>
  <li>Step 1 : Add a new folder into your desired directory</li>
  <li>Step 2 : Go to <a href="www.github.com/Bagaar/homestead">www.github.com/Bagaar/homestead</a></li>
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
    <li>add to 'providers' : 'Teman\Cms\CmsServiceProvider'
  </ul>

<li>Step 9 : In the terminal execute the command : 'composer update'</li>
  <ul>
  <li>Now if you run php artisan, you should see 'cms:install' and 'cms:package'
  </ul>
  
<li>Step 10 : In the terminal execute the command : 'php artisan cms:install'
</ul>
<h5>Installation is complete</h5>
