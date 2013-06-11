<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Util
 *
 * @author isai
 */
class Util {
    public static function redirect($url){
        $url = strtolower($url);
        if (! headers_sent()) {
            header('Location: '.$url);
            exit;
        } else {
            $html = '<script type="text/javascript">'
                  . '    window.location.href="' . $url . '";'
                  . '</script>'
                  . '<noscript>'
                  . '    <meta http-equiv="refresh" content="0;url=' . $url . '" />'
                  . '</noscript>';
            echo $html;
            exit;
        }
    }

    public static function getStatesFromMexico()
    {
        $arrStates = array('Aguascalientes','Baja California');
    }

    public static function randomChars($length,$type=0) {
        $key = '';
        switch ($type) {
            case 0: $pattern = "1234567890abcdefghijklmnopqrstuvwxyz"; break;
            case 1: $pattern = 'abcdefghijklmnopqrstuvwxyz'; break;
            case 2: $pattern = '1234567890'; break;
        }
        $max = strlen($pattern)-1;
        for($i=0;$i < $length;$i++){
            $key .= $pattern{mt_rand(0,$max)};

       }
        return $key;
    }

      public static function createLabel($strName){
        $strLabel = '';
        if ( strpos($strName,'_')  !== false){
            foreach(explode('_',$strName) as $strLetra){
                $strLabel .= ucfirst($strLetra).' ';
            }
        } else {
            $strLabel = ucfirst($strName);
        }

        return $strLabel;
    }
}

