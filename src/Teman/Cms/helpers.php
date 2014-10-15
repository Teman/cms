<?php

if ( ! function_exists('set_active_route') ){

    function set_active_route( $route, $include_children_uri = true, $classname = 'active' ){

        $uri = URL::route($route, [], false);

        /*
         * if the uri is not root (/), remove the leading '/'
         * Request::is() doesn't like the leading '/'
         */
        if ( strlen($uri) > 1 && $uri[0] == '/' ){
            $uri = substr($uri, 1, strlen($uri) - 1);
        }

        $uri_matches = false;

        if ( Request::is( $uri ) ){
            $uri_matches = true;
        }


        if ( $include_children_uri ){

            if ( Request::is( $uri . '/*' ) ){
                $uri_matches = true;
            }
        }


        if ( $uri_matches ){
            return $classname;
        }

        return '';
    }

}


if ( ! function_exists('set_page_title') ){

    function set_page_title($title, $useCmsName=true)
    {
        if ($useCmsName) {
            $title .= ' | ' . Config::get('cms::title');
        }
        View::share('pageTitle', $title);
    }
}

if ( ! function_exists('cms_menu') ) {

    function cms_menu($route)
    {
        // fancy active state hackery by jroen
        $url = explode( '/', str_replace( '://', '', route($route) ) );
        $path = explode( '/', Route::current()->getPath() );
        array_shift($url);
        
        // let's see if first two indexes of array are the same,
        // so we don't need to match every action on a controller.
        if ( array_slice($url,0,2) ==  array_slice($path,0,2) ) {
            echo 'active';
        }
    }

}