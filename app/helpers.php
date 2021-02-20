<?php
use App\Lib\Jdf;

function getTimestamp($date,$type)
{
    $Jdf=new Jdf();
    $time=0;
    $e=explode('/',$date);
    if(sizeof($e)==3)
    {
        $y=$e[0];
        $m=$e[1];
        $d=$e[2];
        if($type=='first')
        {
            $time=$Jdf->jmktime(0,0,0,$m,$d,$y);
        }
        else{
            $time=$Jdf->jmktime(23,59,59,$m,$d,$y);
        }
    }
    return $time;
}

function percent($price1,$price2){
    $a=($price1/$price2)*100;
    $a=100-$a;
    $a=round($a);
    return $a;
}

function timeOffer($timeOffer){
   $time= $timeOffer-time();
   return $time;
}
