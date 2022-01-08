<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LanguageLoader
{
    function initialize() 
    {
        $CI =& get_instance();
        $CI->load->helper('language');
        $siteLang = $CI->session->userdata('site_lang');
        if ($siteLang) {
            $CI->lang->load('login',$siteLang);
        } else {
            $CI->lang->load('login','spanish');
        }
    }
}