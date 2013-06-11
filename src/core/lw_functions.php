<?php

function lw_echo(&$data,$intUtf8=-1)
{
    if( isset($data) && !empty($data) && filter_var($intUtf8,FILTER_VALIDATE_INT) ){
        switch($intUtf8){
            case -1:
                echo $data;
                break;
            case 1:
                echo utf8_encode($data);
                break;
            case 2:
                echo utf8_decode($data);
                break;
            default :
                break;
        }   
    } 
}

function dump($mixed){
    echo '<pre>';
    var_dump($mixed);
    echo '</pre>';
}
function _link($section='home',$action='index',$extra= ''){
    return HOME.'?section='.$section.'&action='.$action.$extra;
}
function go($section='home',$action='index',$extra= ''){
    if(is_array($extra)){
        $i = 1;
        $outParams = '&';
        foreach($extra as $item){
            $outParams .= 'param'.$i.'='.$item.'&';
            $i++;
        }
    } else {
        $outParams = $extra;
    }
    return _link($section, $action, $outParams);
}

function _l($valueKey){
    if (isset(FrontEnd::$langContent[$valueKey]) && is_array(FrontEnd::$langContent[$valueKey])){
        $row = FrontEnd::$langContent[$valueKey];
        if($row['sys_status'] == 'ACTIVO'){
            echo $row['value'._L];
        }
    }
    
}
/**
 * Regresa el dia de la semana
 * @param type $fecha Y-m-d
 * return String dia de la semana
 */
function get_dia_semana($fecha=null){
    
    
    if(is_null($fecha)){
        $fecha = time();
    } else {
        $aDias = explode('-',$fecha);
        $fecha = mktime(0, 0,0, $aDias[1], $aDias[2], $aDias[0]);
    }
    $dia = date('N',$fecha);
    return $dia;

}