<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 10:47
 */
namespace Admin\Model;
use Think\Model;

class ModuleModel extends Model{
    //列表
    public function getAllModules($is_online=null) {
        $condition=array();
        if(isset($is_online)){
            $condition=array("online"=>$is_online);
        }
        $order = ' module_sort asc,module_id asc';
        $list=$this->where($condition)->order($order)->select();
        if ($list) {
            return $list;
        }
        return array ();
    }

    public function getModuleForOptions() {
        $module_options_array = array ();
        $module_list = $this->getAllModules (1);

        foreach ( $module_list as $module ) {
            $module_options_array [$module ['module_id']] = $module ['module_name'];
        }

        return $module_options_array;
    }
}