<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo ($page_title); ?> - <?php echo (C("TITLE")); ?></title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
      <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
      <script src="/Public/Admin/js/jquery-2.1.4.js"></script>
      <script src="/Public/Admin/js/js.js"></script>

  </head>


  <div id="header">
      <table width="1200" border="0" cellspacing="0" cellpadding="0" class="header_nr">
          <tr>
              <td height="69"><img src="/Public/Admin/images/sy_03.jpg" width="53" height="23" /><a href="/admin.php">首页</a></td>
              <td align="right">欢迎，<?php echo ($user_info["user_name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('Login/logout');?>">退出</a></td>
          </tr>
      </table>
  </div>

<div id="main">
<div id="left">
		<div class="left_tb"><img src="/Public/Admin/images/sy_07.jpg" width="248" height="154" /></div>
		<div class="left_nr">
			<div class="sideMenu">
				<ul>
				<?php if(is_array($sidebar)): foreach($sidebar as $key=>$module): if(count($module['menu_list']) > 0): if($module['module_id'] == $current_module_id): ?><li class="nLi on">
					<h3 style="background-color:#541b86"><?php echo ($module["module_name"]); ?></h3>
				<ul class="sub">
					<?php else: ?>
					<li class="nLi">
						<h3><?php echo ($module["module_name"]); ?></h3>
					<ul class="sub"><?php endif; ?>
						<?php if(is_array($module['menu_list'])): foreach($module['menu_list'] as $key=>$menu_list): if(strtolower(substr($menu_list.menu_url,0,7)) == 'http://'): if($menu_list['menu_id'] == $content_header['menu_id']): ?><li style="background-color:#412a54"><a target=_blank href="<?php echo U($menu_list['menu_url']);?>"><?php echo ($menu_list["menu_name"]); ?></a></li>
						<?php else: ?>
						<li><a target=_blank href="<?php echo U($menu_list['menu_url']);?>"><?php echo ($menu_list["menu_name"]); ?></a></li><?php endif; ?>
						<?php else: ?>
						<?php if($menu_list['menu_id'] == $content_header['menu_id']): ?><li style="background-color:#412a54"><a href="<?php echo U($menu_list['menu_url']);?>"><?php echo ($menu_list["menu_name"]); ?></a></li>
						<?php else: ?>
						<li><a href="<?php echo U($menu_list['menu_url']);?>"><?php echo ($menu_list["menu_name"]); ?></a></li><?php endif; endif; endforeach; endif; ?>
					</ul>
						</li><?php endif; endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>
	 <!--- 以上为左侧菜单栏 sidebar --->

	<div id="right">
		<div class="right_nr">
			<table width="855" border="0" cellspacing="0" cellpadding="0" class="right_nr_bt">
				<tr>
					<td width="151" height="50" align="center" style="background-color:#541b86"><?php echo ($content_header["menu_name"]); ?></td>
					<td width="574">
						<?php if($content_header['menu_id'] ==106): ?><div class="cp_ss">
							<form action="" id="search" method="get">
						<input value="<?php echo ($_GET['search']); ?>" type="text" name="search" placeholder="搜索产品" class="cp_ss_sr">
						<input type="button" onclick="formsub();" class="cp_ss_an">
							</form>
					</div>
							<script>
								function formsub(){
									$("#search").submit();
								}
							</script>
					</td>
					<td width="130"><div class="cp_xz"><a href="<?php echo U('Product/add');?>">新增产品</a></div></td>
					<?php elseif($content_header['menu_id'] ==107): ?>
					<div class="cp_ss">
						<form action="" id="search" method="get">
						<input name="search"  value="<?php echo ($_GET['search']); ?>" type="text" placeholder="搜索经销商" class="cp_ss_sr">
						<input name="" type="button" onclick="formsub();" class="cp_ss_an">
						</form>
						<script>
							function formsub(){
								$("#search").submit();
							}
						</script>
					</div>

					</td>
					<td width="130"><div class="cp_xz"><a href="<?php echo U('Dealer/add');?>">新增经销商</a></div></td>
					<?php elseif($content_header['menu_id'] ==108): ?>
					<div class="cp_ss">
						<form action="" id="search" method="get">
						<input name="search" value="<?php echo ($_GET['search']); ?>" type="text" placeholder="搜索设计师" class="cp_ss_sr">
						<input name="" type="button"  onclick="formsub();" class="cp_ss_an">
						</form>
						<script>
							function formsub(){
								$("#search").submit();
							}
						</script>
					</div>

					</td>
					<td width="130"><div class="cp_xz"><a href="<?php echo U('Contact/addMsg');?>">批量联络</a></div></td>
					<?php elseif($content_header['menu_id'] ==11): ?>

					</td>
					<td width="130"><div class="cp_xz"><a href="<?php echo U('Module/add');?>">添加模块</a></div></td>
					<?php elseif($content_header['menu_id'] ==14): ?>

					</td>
					<td width="130"><div class="cp_xz"><a href="<?php echo U('Menu/add');?>">添加菜单</a></div></td>
					<?php elseif($content_header['menu_id'] ==116): ?>

					</td>
					<td width="130"><div class="cp_xz"><a href="<?php echo U('Product/category_add');?>">添加分类</a></div></td>
					<?php elseif($content_header['menu_id'] ==7): ?>

					</td>
					<td width="130"><div class="cp_xz"><a href="<?php echo U('Group/add');?>">添加账号组</a></div></td><?php endif; ?>
				</tr>
			</table>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<?php echo ($osadmin_action_alert); ?>
<?php echo ($osadmin_quick_note); ?>
<div class="btn-toolbar" style="margin-bottom:2px;">
    <a data-toggle="collapse" data-target="#search"  href="#" title= "检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>
<!--<?php if($_GET['search']): ?>-->
<!--<div id="search" class="collapse in">-->
    <!--<?php else: ?>-->
    <!--<div id="search" class="collapse out" >-->
        <!--<?php endif; ?>-->
        <!--<form class="form_search"  action="" method="GET" style="margin-bottom:0px">-->
            <!--<div style="float:left;margin-right:5px">-->
                <!--<label>选择账号组</label>-->
                <!--<{html_options name=user_group id="DropDownTimezone" class="input-xlarge" options=$group_options selected=$_GET.user_group}>-->
            <!--</div>-->
            <!--<div style="float:left;margin-right:5px">-->
                <!--<label>查询所有用户请留空</label>-->
                <!--<input type="text" name="user_name" value="<<?php echo ($_GET["user_name"]); ?>>" placeholder="输入登录名" >-->
                <!--<input type="hidden" name="search" value="1" >-->
            <!--</div>-->
            <!--<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">-->
                <!--<button type="submit" class="btn btn-primary">检索</button>-->
            <!--</div>-->
            <!--<div style="clear:both;"></div>-->
        <!--</form>-->
    <!--</div>-->
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">账号列表</a>
        <div id="page-stats" class="block-body collapse in">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width:20px">#</th>
                    <th style="width:80px">登录名</th>
                    <th style="width:100px">姓名</th>
                    <th style="width:100px">手机</th>
                    <th style="width:80px">邮箱</th>
                    <th style="width:80px">登录时间</th>
                    <th style="width:80px">登录IP</th>
                    <th style="width:80px">Group#</th>
                    <th style="width:80px">描述</th>
                    <th style="width:80px">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($user_infos)): foreach($user_infos as $key=>$user_info): ?><tr>
                    <td><?php echo ($user_info["user_id"]); ?></td>
                    <td><?php echo ($user_info["user_name"]); ?></td>
                    <td><?php echo ($user_info["real_name"]); ?></td>
                    <td><?php echo ($user_info["mobile"]); ?></td>
                    <td><?php echo ($user_info["email"]); ?></td>
                    <td><?php echo ($user_info["login_time"]); ?></td>
                    <td><?php echo ($user_info["login_ip"]); ?></td>
                    <td><?php echo ($user_info["group_name"]); ?></td>
                    <td><?php echo ($user_info["user_desc"]); ?></td>
                    <td>
                        <a href="user_modify.php?user_id=<<?php echo ($user_info["user_id"]); ?>>" title= "修改" ><i class="icon-pencil"></i></a>
                        &nbsp;

                        <?php if($user_info['user_id'] != 1): if($user_info['status'] == 1): ?><a data-toggle="modal" href="#myModal"  title= "封停账号" ><i class="icon-pause" href="users.php?page_no=<<?php echo ($page_no); ?>>&method=pause&user_id=<<?php echo ($user_info["user_id"]); ?>>"></i></a><?php endif; ?>
                        <?php if($user_info['status'] == 0): ?><a data-toggle="modal" href="#myModal" title= "解封账号" ><i class="icon-play" href="users.php?page_no=<<?php echo ($page_no); ?>>&method=play&user_id=<<?php echo ($user_info["user_id"]); ?>>"></i></a><?php endif; ?>
                        &nbsp;
                        <a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="users.php?page_no=<<?php echo ($page_no); ?>>&method=del&user_id=<<?php echo ($user_info["user_id"]); ?>>" ></i></a><?php endif; ?>
                    </td>
                </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <!--- START 分页模板 --->
            <?php echo ($page_html); ?>

            <!--- END --->
        </div>
    </div>

<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
</div>
	</body>
<?php echo ($action_confirm); ?>
</html>