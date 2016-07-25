<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/20
 * Time: 11:24
 */

function Homelog($user_name,$action,$class_name,$class_obj,$result){
    if(empty($user_name)||empty($action)||empty($class_name)||empty($class_obj)||empty($result)){
            return false;
    }
    $data=array(
        "user_name"=>$user_name,
        "action"=>$action,
        "class_name"=>$class_name,
        "class_obj"=>$class_obj,
        "result"=>$result,
        "op_time"=>time()
    );
    $res=M("Sys_log")->add($data);
    return $res;
}

function encrypt($value){
    if(!$value){return false;}
    $key = C('SECRET');
    $text = $value;
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
    return trim(base64_encode($crypttext)); //encode for cookie
}

function decrypt($value){
    if(!$value){return false;}
    $key =  C('SECRET');
    $crypttext = base64_decode($value); //decode cookie
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
    return trim($decrypttext);
}

function setCookieRemember($encrypted,$day=7){
    setcookie("casarte_remember",$encrypted,time()+3600*24*$day);
}

function getCookieRemember(){
    $encrypted = $_COOKIE["casarte_remember"];
    $base64=urldecode($encrypted);
    return decrypt($base64);
}

//根据分类获取对应的产品信息
function getProductsByCate($cate_id){
    $products=array();
    if(!empty($cate_id)){
        $condition=array(
            "cate_id"=>$cate_id,
        );
        $products=M("Product")->where($condition)->order("sort ASC,createtime DESC")->limit(16)->select();
        foreach($products as $k=>$v){
            if(!empty($v['pics'])) {
                $where['id'] = array(
                    "IN", $v['pics']
                );
                $files = M("File")->where($where)->select();
                $products[$k]["picpath"]='/Uploads/Picture/'.$files[0]['savepath'].$files[0]['savename'];
            }
        }
        return $products;
    }else{
        return $products;
    }
}

//获取用户所在地区
function getLocation($city_id,$area_id){
    if(!empty($city_id)&&!empty($area_id)){
        $city=M("Area")->field("area_name")->where("area_id=".$city_id)->find();
        $area=M("Area")->field("area_name")->where("area_id=".$area_id)->find();
        return $city['area_name'].$area['area_name'];
    }else{
        return false;
    }
}
//根据等级规则返回等级名称
function getLevel($level){
    $flag="白金会员";
    switch($level){
        case 0:
            $flag="白金会员";
            break;
        case 1:
            $flag="黄金会员";
            break;
        default:
            $flag="白金会员";
            break;
    }
    return $flag;
}
//根据传来的pics返回第一张图
function getImg($pics){
    if(!empty($pics)) {
        $arrpic = explode(",", $pics);
        $file = M('File')->find($arrpic[0]);
        if(!empty($file)){
        $imgurl="/Uploads/Picture/".$file["savepath"].$file['savename'];
        return $imgurl;
        }else{
            return false;
        }
    }else{
        return false;
    }
}