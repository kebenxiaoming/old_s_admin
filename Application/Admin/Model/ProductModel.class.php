<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/19
 * Time: 14:52
 */
namespace Admin\Model;
use Think\Model;

class ProductModel extends Model{
    protected $_validate = array(
        array('detail','require','产品内容必须填写！'), //默认情况下用正则进行验证
        array('price','require','产品价格必须填写！'), //默认情况下用正则进行验证
        array('pics','require','产品图片必须填写！'), //默认情况下用正则进行验证
        array('parameter','require','产品参数必须填写！'), //默认情况下用正则进行验证
        array('title','require','产品标题必须填写！'), //默认情况下用正则进行验证
    );
}