<?php

/**
 * Description of Date
 *
 * @author isai
 * 23/06/2011
 */
class Date extends DateTime {

    public function  __construct() {
        
    }

    /**
     * formatea una fecha humanizada a formato sql <br/>
     * ejemplo: 23/06/2011 a 2011-06-23
     * @param <type> $datValue fecha de entrada
     * @return <type> fecha formateada
     */
    public static function formatBySql($datValue)
    {
        if ( is_null($datValue) || !is_string($datValue) ) {
            return false;
        }
        if ( Filter::evaluate(Filter::DATE_SQL, $datValue) ){
            return $datValue;
        }
//        if ( Filter::evaluate(Filter::DATE_TIMESTAMP, $datValue) ){
//            $datValue = date('Y-m-d',$datValue);
//            return $datValue;
//        }

        list($day,$month,$year) = explode('/',$datValue);
        if ( is_numeric($year) && is_numeric($month) && is_numeric($day)  ){
            if ( checkdate($month, $day, $year) ){
                return  $year.'-'.$month.'-'.$day;
            } else {
                return false;
            }
        } else{
            return false;
        }
    }

    public function formatToHuman($value)
    {
        if(empty($value)){
            return false;
        }

        if( Filter::evaluate(Filter::DATE_SQL, $value) ){
            list($year,$month,$day) = explode('-',$value);
            return "{$day}/{$month}/{$year}";
        } else {
            return false;
        }
    }

}

