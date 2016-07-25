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

<div class="wzgl_czjl">
    <?php if(is_array($logs)): foreach($logs as $key=>$sys_log): ?><table width="855" border="0" cellspacing="0" cellpadding="0" class="wzgl_czjl_lb">
        <tr>
            <td width="16" height="40"><img src="/Public/Admin/images/dian_03.jpg" width="5" height="5" /></td>
            <td width="104" style="color:#900"><?php echo ($sys_log["user_name"]); ?></td>
            <td width="549" ><?php echo ($sys_log["record"]); ?></td>
            <td width="186" align="right" style="color:#666"><?php echo (date("y-m-d H:i:s",$sys_log["op_time"])); ?></td>
        </tr>
    </table><?php endforeach; endif; ?>
    <div class="intro_cxcp_nr_fy"> <?php echo ($page_html); ?></div>
</div>
</div>
</div>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
</div>
	</body>
<?php echo ($action_confirm); ?>
</html>