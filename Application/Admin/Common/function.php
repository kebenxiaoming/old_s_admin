<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 9:35
 */

function Adminlog($user_name,$action,$class_name,$class_obj,$result){
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
    setcookie("sunny_remember",$encrypted,time()+3600*24*$day);
}

function getCookieRemember(){
    $encrypted = $_COOKIE["sunny_remember"];
    $base64=urldecode($encrypted);
    return decrypt($base64);
}

function getSysInfo() {
    $sys_info_array = array ();
    $sys_info_array ['gmt_time'] = gmdate ( "Y年m月d日 H:i:s", time () );
    $sys_info_array ['bj_time'] = gmdate ( "Y年m月d日 H:i:s", time () + 8 * 3600 );
    $sys_info_array ['server_ip'] = gethostbyname ( $_SERVER ["SERVER_NAME"] );
    $sys_info_array ['software'] = $_SERVER ["SERVER_SOFTWARE"];
    $sys_info_array ['port'] = $_SERVER ["SERVER_PORT"];
    $sys_info_array ['admin'] = $_SERVER ["SERVER_ADMIN"];
    $sys_info_array ['diskfree'] = intval ( diskfreespace ( "." ) / (1024 * 1024) ) . 'Mb';
    $sys_info_array ['current_user'] = @get_current_user ();
    $sys_info_array ['timezone'] = date_default_timezone_get();
    $mysql_version = M()->query("select version()");
    $sys_info_array ['mysql_version'] = $mysql_version[0]['version()'];
    return $sys_info_array;
}

function renderJsConfirm($class,$confirm_title="确定要这样做吗？"){
        $confirm_html="<script>";
        if(!is_array($class)){
            $class=explode(',',$class);
        }

        foreach($class as $item){
            $confirm_html .= "
				$('.$item').click(function(){
						
						var href=$(this).attr('goto');
						var result=window.confirm('$confirm_title');
							if(result){
								window.location.href=href;
							}
					})
				";
        }

        $confirm_html.="</script>

";
        return $confirm_html;
}

//获取用户所在分组
function getGroupName($group_id){
    if(empty($group_id)){
        return false;
    }
    $name=M("UserGroup")->field("group_name")->find($group_id);
    if(!empty($name)){
        return $name['group_name'];
    }else{
        return false;
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
