<?php

namespace common\classes;

class Obj
    {
        function  array_culmun($arr,$string)
        {
            $tmp=array();
            foreach($arr as $key=>$val)
            {
                $tmp[]=$val[$string];
            }
            return $tmp;
        }
    }

?>