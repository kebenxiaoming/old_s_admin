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

<div class="cpgl_cplb">
    <script src="/Public/Admin/js/jquery.uploadifive.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/uploadifive.css">
    <form method="post" action="">
        <input type="hidden" value="<?php echo ($_POST["pics"]); ?>" name="pics" id="picsval">
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cptj">
            <tr>
                <td width="106" height="80">产品类型</td>
                <td width="749"><div class="cpgl_cptj_xl">
                    <select name="cate_id">
                        <?php if(is_array($categories)): foreach($categories as $key=>$category): if($_POST['cate_id'] == $category['id']): ?><option value="<?php echo ($category["id"]); ?>" selected><?php echo ($category["category_name"]); ?></option>
                        <?php else: ?>
                        <option value="<?php echo ($category["id"]); ?>"><?php echo ($category["category_name"]); ?></option><?php endif; endforeach; endif; ?>
                    </select>
                </div></td>
            </tr>
            <tr>
                <td height="80">产品名称</td>
                <td><input name="title" type="text" class="cpgl_cptj_mc" value="<?php echo ($_POST["title"]); ?>" required="true"></td>
            </tr>
            <tr>
                <td width="106" height="80">产品价格</td>
                <td width="749"><input name="price" value="<?php echo ($_POST["price"]); ?>" type="text" class="cpgl_cptj_mc" required="true"></td>
            </tr>
            <tr>
                <td height="80">产品图片</td>
                <td class="cpgl_cptj_sc">
                    <input type="file" id="images" class="input-xlarge" autofocus="true">
                    <p>最大100KB，支持jpg，gif，png格式。</p>
                    <div id="preview"></div>
                </td>
            </tr>
            <tr>
                <td height="80">产品排序</td>
                <td><input name="sort" type="text" class="cpgl_cptj_mc"  value="<?php echo ($_POST["sort"]); ?>" placeholder="数字越小越靠前"></td>
            </tr>
            <tr>
                <td height="177" valign="top" style="padding-top:30px;">产品参数</td>
                <td><textarea name="parameter" cols="" rows="" class="cpgl_cptj_cs" required="true"><?php echo ($_POST["parameter"]); ?></textarea></td>
            </tr>
            <tr>
                <td height="80">产品详情</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td  colspan="2"><div class="dsjj_nr1">

                    <textarea name="detail" id="detail" ><?php echo ($_POST["detail"]); ?></textarea>

                </div></td>
            </tr>
            <tr>
                <td height="80" colspan="2"><div class="dsjj_nr_menu">
                    <input name="" type="submit" value="提交" />
                </div></td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>

<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<link rel="stylesheet" href="/Public/Admin/js/kindeditor/default/default.css" />
<script charset="utf-8" src="/Public/Admin/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/Public/Admin/js/kindeditor/zh_CN.js"></script>
<script type="text/javascript">
    var editor_content;
    KindEditor.ready(function(K) {
        editor_content = K.create('textarea[name="detail"]', {
            allowFileManager : false,
            themesPath: K.basePath,
            width: '100%',
            height: '450',
            resizeType: 1,
            pasteType : 2,
            urlType : 'absolute',
            fileManagerJson : '',
            uploadJson : '<?php echo U("File/uploadEdit");?>',
            extraFileUploadParams: {
            }
        });
    });
    $(function() {
        $('#images').uploadifive({
            'uploadScript': '<?php echo U("File/uploadPicture");?>',
            'auto': true,
            'buttonText': "",
            'uploadLimit': 3,
            'onUploadComplete': function (file, data, response) {
                var filedata = JSON.parse(data);
                var images = $("#picsval").val();
                if (images == "") {
                    var newimages = filedata.data.Filedata.id;
                } else {
                    var newimages = images + "," + filedata.data.Filedata.id;
                }
                if (filedata.status == 1) {
                    $("#preview").append("<div style='width:100px;height:100px;float:left;'><img style='width:100px;height:100px;' src='" + filedata.data.Filedata.path + "'></div>");
                    $("#preview").css("display", "block");
                    $("#picsval").val(newimages);
                } else {
                    alert(filedata.info);
                    return;
                }
            }
        })
    });
</script>

<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
</div>
	</body>
<?php echo ($action_confirm); ?>
</html>