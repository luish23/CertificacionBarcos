<?php
/**
* @author Luis Henández
*/
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @param string
* @return object 
*/

function getDir($dir)
{
    if ( !is_dir( $dir ) ) {
        mkdir( $dir, 0775, true );       
    }

    if($path = realpath($dir)){
        return ($path !== false AND is_dir($path)) ? $path : false;
    }
}