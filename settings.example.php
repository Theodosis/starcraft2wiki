<?php

    /*
     * This settings file is for the sandbox page (and later for the production page).
     * For local copies, you should create a localsettings.php file.
     */

    $settings = array(
        'base_url' => '', // used on <base href="">
        'testing' => true, // set to false on production
        'db' => array(
            'host' => '',
            'user' => '',
            'pass' => '',
            'name' => ''
        ),
        'cookiename' => ''
    );

    if ( $settings[ 'testing' ] ) { // no need to check for local settings file on production
        $localsettings = @include 'localsettings.php';
        if ( is_array( $localsettings ) ) {
            foreach ( $localsettings as $key => $value ) {
                $settings[ $key ] = $value;
            }
        }
    }

    return $settings;

?>
