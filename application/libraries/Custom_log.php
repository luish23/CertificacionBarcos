<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 7.2 or newer
 *
 * @package         CodeIgniter
 * @author          ExpressionEngine Dev Team
 * @copyright       Copyright (c) 2021, SocialytyConnect.
 * @license         http://codeigniter.com/user_guide/license.html
 * @link            http://codeigniter.com
 * @since           Version 1.1
 * @filesource
 */
// ------------------------------------------------------------------------
/**
 * MY_Logging Class
 *
 * This library assumes that you have a config item called
 * $config['show_in_log'] = array();
 * you can then create any error level you would like, using the following format
 * $config['show_in_log']= array('DEBUG','ERROR','INFO','SPECIAL','MY_ERROR_GROUP','ETC_GROUP'); 
 * Setting the array to empty will log all error messages. 
 * Deleting this config item entirely will default to the standard
 * error loggin threshold config item. 
 * EXT: The PHP file extension
 * FCPATH: Path to the front controller (this file) (root of CI)
 * SELF: The name of THIS file (index.php)
 * BASEPATH: Path to the system folder
 * APPPATH: The path to the “application” folder
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Logging
 * @author          Luis Hernández
 */
class Custom_log extends CI_Log {
    /**
     * Constructor
     */
    public function __construct()
    {
        $config =& get_config();

        $this->_log_path = ($config['log_path'] != '') ? $config['log_path'] : APPPATH.'logs/';

        if ( ! is_dir($this->_log_path) OR ! is_really_writable($this->_log_path))
        {
            $this->_enabled = FALSE;
        }

        if (is_numeric($config['log_threshold']))
        {
            $this->_threshold = $config['log_threshold'];
        }

        if ($config['log_date_format'] != '')
        {
            $this->_date_fmt_raw = $config['log_date_format'];
            $this->_date_fmt = substr($config['log_date_format'], 0, 5);
        }

    }

    private function isCommandLineInterface()
    {
        return (php_sapi_name() === 'cli');
    }

    // --------------------------------------------------------------------
    /**
     * Write Log File
     *
     * Generally this function will be called using the global log_message() function
     *
     * @access      public
     * @param       level       string      ['DEBUG','ERROR','INFO','NOTICE','MYSQL','ALL']
     * @param       msg         string      the error message
     * @param       file_name   string name file
     * @return      bool
     */


    public function write_log($level = 'ERROR', $msg, $file_name = '')
    {
        if ($this->_enabled === FALSE)
        {
            return FALSE;
        }

        $level = strtoupper($level);

        if($file_name == ''){
            $file_name = 'log-'.date($this->_date_fmt).'.log';
        }else{
            $file_name = 'log-'.$file_name.'-'.date($this->_date_fmt).'.log';
        }   

        $filepath = $this->_log_path. $file_name;
        $message  = '';

        if ( ! file_exists($filepath))
        {
            $message .= "<"."?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?".">\n\n";
        }

        if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
        {
            return FALSE;
        }

        if ($this->isCommandLineInterface()) {
            $message .= 'CMD >> ';
        }

        $message .= $level.' '.(($level == 'INFO') ? ' -' : '-').' '.date($this->_date_fmt_raw). ' --> '.$msg."\n";

        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);

        @chmod($filepath, FILE_WRITE_MODE);
        return TRUE;
    }

    public function write_msg($msgInData, $file, $msg)
    {
        $fp = APPPATH.'logs/'.$file;
        file_put_contents($fp, "\n".date($this->_date_fmt_raw) . ' --> ' . $msgInData, FILE_APPEND);
        return $msg;
    }

}