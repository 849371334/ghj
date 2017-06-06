<?php
namespace common\helps;

use Yii;

class  Ectype {
    
    public function md8($str)
    {
        return  base_convert(substr(md5($str), 0, 15) , 16, 10);
    }
}
