<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class pdf {
    
    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param="A4-L")
    {
        //$param é a orientação do papel
        include_once APPPATH.'/third_party/mpdf60/mpdf.php';
         
        // if ($params == NULL)
        // {
        //     $param = '"utf-8","A4-L","","",0,10,10,10,6,3';         
        // }
         
        return new mPDF("utf-8",$param,"","",10,10,10,10,6,3);
    }
}