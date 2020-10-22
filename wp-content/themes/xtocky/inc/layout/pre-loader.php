<?php 
/* 
 * preloader html
 */

if(!function_exists('xtocky_enable_loader')){
    function xtocky_enable_loader(){ 
        $enable_loader = xtocky_get_option_data('optn_enable_loader', false);        
        if($enable_loader == 1){
            xtocky_get_template('site-loading');
        }       
    }
}