<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/19
 * Time: 16:08
 */
namespace Home\Controller;

class AreaController extends HomeController{
    //获取省的信息
    public function getProvinces(){
        $condition=array("area_type"=>1);

        $province_list=M("Area")->field("area_id as id,area_name as name")->where($condition)->select();

        if(count($province_list) == 1){
            $return['error'] = 2;
            $return['id'] = $province_list[0]['id'];
            $return['name'] = $province_list[0]['name'];
        }else if(!empty($province_list)){
            $return['error'] = 0;
            $return['list'] = $province_list;
        }else{
            $return['error'] = 1;
            $return['info'] = '没有开启了的省份！';
        }
        exit(json_encode($return));
    }
    //根据省获取对应的市
    public function getCities(){
        $id=intval($_POST['id']);
        $type=$_POST['type'];
        $name=strval($_POST['name']);
        $condition=array("area_pid"=>$id);

        $city_list=M("Area")->field("area_id as id,area_name as name")->where($condition)->select();

        if(count($city_list) == 1 && !$type){
            $return['error'] = 2;
            $return['id'] = $city_list[0]['id'];
            $return['name'] = $city_list[0]['name'];
        }else if(!empty($city_list)){
            $return['error'] = 0;
            $return['list'] = $city_list;
        }else{
            $return['error'] = 1;
            $return['info'] = $name .' 省份下没有开启了的城市！';
        }
        exit(json_encode($return));
    }
    //根据市获取对应的区域信息
    public function getAreas(){
        $id= intval($_POST['id']);
        $name=strval($_POST['name']);
        extract ( $_POST, EXTR_IF_EXISTS );

        $condition=array("area_pid"=>$id);

        $area_list=M("Area")->field("area_id as id,area_name as name")->where($condition)->select();

        if(!empty($area_list)){
            $return['error'] = 0;
            $return['list'] = $area_list;
        }else{
            $return['error'] = 1;
            $return['info'] = $name .' 城市下没有开启了的区域！';
        }
        exit(json_encode($return));
    }
}