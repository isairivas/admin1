<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Filter
 *
 * @author isai
 * 02/06/2011
 * 21/07/2011
 */
class Filter {

    const INT = 1;
    const FLOAT = 2;
    const STRING = 3;
    const ID = 4;
    const EMAIL = 5;
    const CODE_POSTAL = 6;
    const BOOLEAN = 7;
    const URL = 8;
    const IP = 9;
    const HTML = 10;
    const TEXT = 11;
    const FULLTEXT = 12;
    const NAME = 13;
    const PASSWORD = 14;
    const ALPHA_NUMERIC = 15;
    const LETTERS = 16;
    const USER = 17;
    const VARIABLE = 18;
    const DATE_SQL = 19;
    const DATE_HUMAN = 20;
    const DATE = 21;
    const DATE_TIMESTAMP = 22;

    public function  __construct() {}
    
    public static function evaluate($filterName,$value)
    {
        if ( empty($value) ){
            return false;
        }
        switch($filterName){
            case self::ID:
                if(!filter_var($value,FILTER_VALIDATE_INT)){
                    Login::out();
                }
                return true;
                break;
            case self::USER:
                return self::isUser($value);
                break;
            case self::EMAIL:
                if (filter_var($value, FILTER_VALIDATE_EMAIL) ){
                    return true;
                } else {
                    return false;
                }
                break;
            case self::INT:
                return filter_var($value,FILTER_VALIDATE_INT);
                break;
            case self::CODE_POSTAL:
                return self::isCodePostal($value);
                break;
            case self::FLOAT:
                return filter_var($value,FILTER_VALIDATE_FLOAT);
                break;
            case self::BOOLEAN:
                return filter_var($value,FILTER_VALIDATE_BOOLEAN);
                break;
            case self::URL:
                return filter_var($value,FILTER_VALIDATE_URL);
                break;
            case self::IP:
                return filter_var($value,FILTER_VALIDATE_IP);
                break;
            case self::HTML:
                break;
            case self::TEXT:
                return is_string($value);
                break;
            case self::FULLTEXT:
                return true;
                break;
            case self::STRING:
                return is_string($value);
                break;
            case self::ALPHA_NUMERIC:
                return !preg_match('/[^ 0-9A-Za-z]/',$value);
                break;
            case self::NAME:
                return !preg_match('/[^ 0-9A-Za-z\.\',]/',$value);
                break;
            case self::PASSWORD:
                return self::isUser($value);
                break;
            case 'stateFromMx':
                return self::isStateFromMx($value);
                break;
            case self::LETTERS:
                return !preg_match('/[^ A-Za-z]/',$value);
                break;
            case self::VARIABLE:
                break;
            case self::DATE_HUMAN:
                return self::isDateHuman($value);
                break;
            case self::DATE_SQL:
                return self::isDateSql($value);
                break;
            case self::DATE_TIMESTAMP:
                return self::isTimeStamp($value);
                break;
            default : return false; break;
        }
    }

    private static function isDateHuman($value) {
        if(empty($value)){
            return false;
        }
        list($dia,$mes,$ano) = explode("/",$value);

        if ( !is_numeric($dia) || !is_numeric($mes) || !is_numeric($ano) ) {
            return false;
        }
        if ( checkdate($mes, $dia, $ano) ) {
            return true;
        } else {
            return false;
        }
    }

    private static function isTimeStamp($value) {
        return self::isDateHuman(date('d/m/Y',$value));
    }

    private static function isDateSql($value) {
        
        if(empty($value)){
            return false;
        }

        list($year,$month,$day) = explode('-',$value);
        if( !filter_var($year, FILTER_VALIDATE_INT) || !is_numeric($month) || !filter_var($day, FILTER_VALIDATE_FLOAT) ){
            return false;
        }
        if(checkdate($month, $day, $year) ){
            return true;
        } else {
            return false;
        }
    }

    private static function isUser($value)
    {
        if ( !is_string($value) ){
            return false;
        }
        //caracteres invalidos
        $arrCharInvalid =
        array(
            '!','"','#','%','&','/','(',')',"'",'=','?','?','?','?','}',']','`',
            '<','>',':',';',',','-','*','+','?','{','^','[','|','?'
            );
        foreach($arrCharInvalid as $char ){
            if (strpos($value, $char) !== false ){
                return false;
            }
        }
        return true;
    }

    private static function isCodePostal($value)
    {
        if(!filter_var($value,FILTER_VALIDATE_INT) ) {
            return false;
        }
        if (strlen($value) != 5 ){
            return false;
        }

        return true;
    }

    private static function isStateFromMx($value)
    {
        
    }
}

