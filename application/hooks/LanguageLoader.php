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
            $CI->lang->load('message',$siteLang);
        } else {
            $CI->lang->load('message','english');
        }
    }
}