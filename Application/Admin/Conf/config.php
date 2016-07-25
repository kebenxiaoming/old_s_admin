<?php
return array(
	//'配置项'=>'配置值'
    "SECRET"=>"whatsafunnnyday",
    "TITLE"=>"卡萨帝crm后台管理",
    "LISTROWS"=>10,
    /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 20*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Picture/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //图片上传相关配置（文件上传类配置）
    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Download/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）
    'PICTURE_UPLOAD_DRIVER'=>'local',
    //日志的解释配置
    "COMMAND_FOR_LOG" => array(
        'SUCCESS' => '成功',
        'ERROR' => '失败',
        'ADD' => '增加',
        'DELETE' => '删除',
        'MODIFY' => '修改',
        'LOGIN' => '登录',
        'LOGOUT' => '退出',
        'PAUSE' => '封停',
        'PLAY' => '解封',
        'DEL' => '删除',
    ),
    //模型

    "CLASS_FOR_LOG" => array(
        'ALL' => '全部',
        'User' => '用户',
        'UserGroup' => '账号组',
        'Module' => '菜单模块',
        'MenuUrl' => '功能',
        'GroupRole' => '权限',
        'QuickNote' => 'QuickNote',
        'Category'=>'产品分类',
        "Product"=>'产品',
        "Dealer"=>'经销商',
        "Designer"=>'设计师',
        "Message"=>'消息',
        "Article"=>'大赛简介',
        "Work"=>'作品',
    ),
);