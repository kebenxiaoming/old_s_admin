<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/18
 * Time: 15:06
 */
namespace Admin\Model;
use Think\Model;

class UserGroupModel extends Model{
    public function getAllGroup(){
        $list=$this->alias("g")->field("g.*,u.user_name as owner_name")->join(C("DB_PREFIX")."user as u ON g.owner_id=u.user_id")->order("g.group_id")->select();
        if ($list) {

            return $list;
        }
        return array ();
    }

    public function getGroupForOptions() {
        $group_list = $this->getAllGroup ();

        foreach ( $group_list as $group ) {
            $group_options_array [$group ['group_id']] = $group ['group_name'];
        }

        return $group_options_array;
    }
}