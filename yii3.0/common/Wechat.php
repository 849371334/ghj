<?php
namespace common;

define("TOKEN", "weixin");

class wechat
{
    //验证签名
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $appID = 'wx6ca5a5119b172ccd';
        $appsecret = 'e0020cc046bce4f2e6780cf72a69c045';
        $token = 'TOKEN';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            echo $echoStr;
            exit;
        }
    }

    //响应消息
    public function responseMsg()
    {

         // $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];  
          $postStr = $_POST;    
         //var_dump($postStr);die;
        if (!empty($postStr)){
             // echo "212";die;
            $this->logger("R \r\n".$postStr);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            // var_dump($RX_TYPE);die;

            //消息类型分离
            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":
                case "shortvideo":
                    $result = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "unknown msg type: ".$RX_TYPE;
                    break;
            }
            $this->logger("T \r\n".$result);
            echo $result;
        }else {
            echo "";
            exit;
        }
    }

    //接收事件消息
    private function receiveEvent($object)
    {
        $content = "";
        switch ($object->Event)
        {
            case "subscribe":
                $content = array();
                $content[] = array("Title"=>"欢迎您关注公众号\n【人为什么活着】\n 【1】可输入如：图文\n 【2】我们的功能很强大\n【3】吃月饼游戏 输入：小兔子",  "Description"=>"你好，点击图片可获得更多信息", "PicUrl"=>"https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1494943659364&di=78f7e674d9b92496f93f6f11d056d605&imgtype=0&src=http%3A%2F%2Fp9.qhimg.com%2Fdmsmty%2F350_200_%2Ft017d891ca365ef60b5.jpg", "Url" =>"http://baike.baidu.com/link?url=PwpfA3dQ_it7SihF5IbFYFji8rsFVwajbRpUDnTuvpQPxj2TxsCyezROAMBk2TY3zz3uzVSjpoqEzUYETDpNRK");
//                $content .= (!empty($object->EventKey))?("\n来自二维码场景 ".str_replace("qrscene_","",$object->EventKey)):"";
                break;
            case "unsubscribe":
                $content = "取消关注";
                break;
            case "CLICK":
                switch ($object->EventKey)
                {
                    case "COMPANY":
                        $content = array();
                        $content[] = array("Title"=>"方倍工作室", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                        break;
                    default:
                        $content = "点击菜单：".$object->EventKey;
                        break;
                }
                break;
            case "VIEW":
                $content = "跳转链接 ".$object->EventKey;
                break;
            case "SCAN":
                $content = "扫描场景 ".$object->EventKey;
                break;
            case "LOCATION":
                $content = "上传位置：纬度 ".$object->Latitude.";经度 ".$object->Longitude;
                break;
            case "scancode_waitmsg":
                if ($object->ScanCodeInfo->ScanType == "qrcode"){
                    $content = "扫码带提示：类型 二维码 结果：".$object->ScanCodeInfo->ScanResult;
                }else if ($object->ScanCodeInfo->ScanType == "barcode"){
                    $codeinfo = explode(",",strval($object->ScanCodeInfo->ScanResult));
                    $codeValue = $codeinfo[1];
                    $content = "扫码带提示：类型 条形码 结果：".$codeValue;
                }else{
                    $content = "扫码带提示：类型 ".$object->ScanCodeInfo->ScanType." 结果：".$object->ScanCodeInfo->ScanResult;
                }
                break;
            case "scancode_push":
                $content = "扫码推事件";
                break;
            case "pic_sysphoto":
                $content = "系统拍照";
                break;
            case "pic_weixin":
                $content = "相册发图：数量 ".$object->SendPicsInfo->Count;
                break;
            case "pic_photo_or_album":
                $content = "拍照或者相册：数量 ".$object->SendPicsInfo->Count;
                break;
            case "location_select":
                $content = "发送位置：标签 ".$object->SendLocationInfo->Label;
                break;
            default:
                $content = "receive a new event: ".$object->Event;
                break;
        }

        if(is_array($content)){
            $result = $this->transmitNews($object, $content);
        }else{
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }

    //接收文本消息
    private function receiveText($object)
    {
        $keyword = trim($object->Content);

        //多客服人工回复模式
        // if (strstr($keyword, "请问在吗") || strstr($keyword, "在线客服")){
        //     $result = $this->transmitService($object);
        //     return $result;
        //}
        //天气
        $str = mb_substr($keyword,-2,2,"UTF-8");
        $str_key = mb_substr($keyword,0,-2,"UTF-8");
        //自动回复模式
        if (strstr($keyword, "地区")){
            $content = "地区介绍";
        }else if (strstr($keyword, "表情")){
            $content = "微笑：/::)\n乒乓：/:oo\n中国：".$this->bytes_to_emoji(0x1F1E8).$this->bytes_to_emoji(0x1F1F3)."\n仙人掌：".$this->bytes_to_emoji(0x1F335);
        }else if (strstr($keyword, "单图文")){
            $content = array();
            $content[] = array("Title"=>"单图文标题",  "Description"=>"单图文内容", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
        }else if (strstr($keyword, "图文") || strstr($keyword, "多图文")){
            $content = array();
            $content[] = array("Title"=>"美女", "Description"=>"123", "PicUrl"=>"http://www.xiansen.top/dashixun/yii2/frontend/web/image/a.jpg", "Url" =>"http://59.110.143.101/image/1.jpg");
            $content[] = array("Title"=>"靓", "Description"=>"456", "PicUrl"=>"http://www.xiansen.top/dashixun/yii2/frontend/web/image/asd.jpg", "Url" =>"http://59.110.143.101/image/2.jpg");
            $content[] = array("Title"=>"女", "Description"=>"789", "PicUrl"=>"http://www.xiansen.top/dashixun/yii2/frontend/web/image/1.bmp", "Url" =>"http://59.110.143.101/image/3.jpg");
        }else if (strstr($keyword, "音乐")){
            $content = array();
            $content = array("Title"=>"最炫民族风", "Description"=>"歌手：凤凰传奇", "MusicUrl"=>"http://mascot-music.stor.sinaapp.com/zxmzf.mp3", "HQMusicUrl"=>"http://mascot-music.stor.sinaapp.com/zxmzf.mp3");
        }else if(strstr($keyword, "最新商品")){
            $model = new IModel('goods');
            $goods = $model->getObj('id=1');
            $content = array();
            $content[] = array("Title"=>$goods['name'],  "Description"=>$goods['search_words'], "PicUrl"=>$goods['img'], "Url" =>"http://www.acfun.tv");
        }elseif(strstr($keyword, "小兔子")){
            $content=array();
            $content[]= array("Title"=>"小兔子吃月饼", "Description"=>"玩玩小游戏，放松下", "PicUrl"=>"http://59.110.143.101/image/1.jpg", "Url" =>"http://59.110.143.101/youxi.html");
        }elseif(strstr($keyword, "游戏")){
            $content="【1】：输入数字1会收到祝福语！，\n【2】：输入数字2会有惊喜";
        }elseif(strstr($keyword, "1")){
            $content="你真美！";
        }elseif(strstr($keyword, "2")){
            $content="联系 * 可获得惊喜";
        }else{
            $word = urlencode($keyword);
            $json=file_get_contents("http://www.tuling123.com/openapi/api?key=a78748c4a45245c9afd2059201da9510&info=".$word);
            $data = json_decode($json, true);
            $content = $data['text'];
        }

        if(is_array($content)){
            if (isset($content[0])){
                $result = $this->transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = $this->transmitMusic($object, $content);
            }
        }else{
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }

    //接收图片消息
    private function receiveImage($object)
    {
        $content = array("MediaId"=>$object->MediaId);
        $result = $this->transmitImage($object, $content);
        return $result;
    }

    //接收位置消息
    // private function receiveLocation($object)
    // {
    //     $content = "你发送的是位置，经度为：".$object->Location_Y."；纬度为：".$object->Location_X."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
    //     $result = $this->transmitText($object, $content);
    //     return $result;
    // }

    //接收语音消息
    private function receiveVoice($object)
    {
        if (isset($object->Recognition) && !empty($object->Recognition)){
            $content = "你刚才说的是：".$object->Recognition;
            $result = $this->transmitText($object, $content);
        }else{
            $content = array("MediaId"=>$object->MediaId);
            $result = $this->transmitVoice($object, $content);
        }
        return $result;
    }

    //接收视频消息
    private function receiveVideo($object)
    {
        $content = "上传视频类型：".$object->MsgType;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    //接收链接消息
    // private function receiveLink($object)
    // {
    //     $content = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
    //     $result = $this->transmitText($object, $content);
    //     return $result;
    // }

    //回复文本消息
    private function transmitText($object, $content)
    {
        if (!isset($content) || empty($content)){
            return "";
        }

        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);

        return $result;
    }

    //回复图文消息
//     private function transmitNews($object, $newsArray)
//     {
//         if(!is_array($newsArray)){
//             return "";
//         }
//         $itemTpl = "        <item>
//             <Title><![CDATA[%s]]></Title>
//             <Description><![CDATA[%s]]></Description>
//             <PicUrl><![CDATA[%s]]></PicUrl>
//             <Url><![CDATA[%s]]></Url>
//         </item>
// ";
//         $item_str = "";
//         foreach ($newsArray as $item){
//             $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
//         }
//         $xmlTpl = "<xml>
//     <ToUserName><![CDATA[%s]]></ToUserName>
//     <FromUserName><![CDATA[%s]]></FromUserName>
//     <CreateTime>%s</CreateTime>
//     <MsgType><![CDATA[news]]></MsgType>
//     <ArticleCount>%s</ArticleCount>
//     <Articles>
// $item_str    </Articles>
// </xml>";

//         $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
//         return $result;
//     }

    //回复音乐消息
    private function transmitMusic($object, $musicArray)
    {
        if(!is_array($musicArray)){
            return "";
        }
        $itemTpl = "<Music>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <MusicUrl><![CDATA[%s]]></MusicUrl>
        <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
    </Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[music]]></MsgType>
    $item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复图片消息
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
        <MediaId><![CDATA[%s]]></MediaId>
    </Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[image]]></MsgType>
    $item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复语音消息
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
        <MediaId><![CDATA[%s]]></MediaId>
    </Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);
        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[voice]]></MsgType>
    $item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复视频消息
    private function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
        <MediaId><![CDATA[%s]]></MediaId>
        <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
    </Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[video]]></MsgType>
    $item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复多客服消息
//     private function transmitService($object)
//     {
//         $xmlTpl = "<xml>
//     <ToUserName><![CDATA[%s]]></ToUserName>
//     <FromUserName><![CDATA[%s]]></FromUserName>
//     <CreateTime>%s</CreateTime>
//     <MsgType><![CDATA[transfer_customer_service]]></MsgType>
// </xml>";
//         $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
//         return $result;
//     }

    //回复第三方接口消息
    // private function relayPart3($url, $rawData)
    // {
    //     $headers = array("Content-Type: text/xml; charset=utf-8");
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
    //     $output = curl_exec($ch);
    //     curl_close($ch);
    //     return $output;
    // }

    //字节转Emoji表情
    // function bytes_to_emoji($cp)
    // {
    //     if ($cp > 0x10000){       # 4 bytes
    //         return chr(0xF0 | (($cp & 0x1C0000) >> 18)).chr(0x80 | (($cp & 0x3F000) >> 12)).chr(0x80 | (($cp & 0xFC0) >> 6)).chr(0x80 | ($cp & 0x3F));
    //     }else if ($cp > 0x800){   # 3 bytes
    //         return chr(0xE0 | (($cp & 0xF000) >> 12)).chr(0x80 | (($cp & 0xFC0) >> 6)).chr(0x80 | ($cp & 0x3F));
    //     }else if ($cp > 0x80){    # 2 bytes
    //         return chr(0xC0 | (($cp & 0x7C0) >> 6)).chr(0x80 | ($cp & 0x3F));
    //     }else{                    # 1 byte
    //         return chr($cp);
    //     }
    // }

    //日志记录
    private function logger($log_content)
    {
        if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){ //LOCAL
            $max_size = 1000000;
            $log_filename = "log.xml";
            if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
            file_put_contents($log_filename, date('Y-m-d H:i:s')." ".$log_content."\r\n", FILE_APPEND);
        }
    }

}

?>