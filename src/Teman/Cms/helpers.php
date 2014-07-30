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