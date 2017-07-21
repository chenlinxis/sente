<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo ($CONF['shopTitle']['fieldValue']); ?>后台管理中心</title>
      <link href="/Public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="/Apps/Admin/View/css/AdminLTE.css" rel="stylesheet" type="text/css" />
      <!--[if lt IE 9]>
      <script src="/Public/js/html5shiv.min.js"></script>
      <script src="/Public/js/respond.min.js"></script>
      <![endif]-->
      <script src="/Public/js/jquery.min.js"></script>
      <script src="/Public/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="/Public/js/common.js"></script>
      <script src="/Public/plugins/plugins/plugins.js"></script>
      <script src="/Public/plugins/formValidator/formValidator-4.1.3.js"></script>
   </head>
   <style>
   input[type=checkbox] {margin-right:2px;}
   </style>
   <script>
   $(function () {
	   $.formValidator.initConfig({
		   theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
				   edit();
			       return false;
			},onError:function(msg){
		}});
	   $("#roleName").formValidator({onFocus:"角色名称至少要输入1个字符",onCorrect:"输入正确"}).inputValidator({min:1,max:20,onError:"你输入的长度不正确,请确认"});
	   var grant = '<?php echo ($object["grant"]); ?>'.split(',');
	   for(var i=0;i<grant.length;i++){
			$('#'+grant[i]).prop('checked',true);
	   }
   });
   function edit(){
	   var params = {};
	   params.id = $('#id').val();
	   params.roleName = $('#roleName').val();
	   var grant = [];
	   $('.grant').each(function(){
		   if($(this).prop('checked'))grant.push($(this).val());
	   });
	   params.grant = grant.join(',');
	   if(grant.length==0){
		   Plugins.Tips({title:'信息提示',icon:'error',content:'请至少选择一个权限!',timeout:1000});
		   return;
	   }
	   Plugins.waitTips({title:'信息提示',content:'正在提交数据，请稍后...'});
		$.post("<?php echo U('Admin/Role/edit');?>",params,function(data,textStatus){
			var json = WST.toJson(data);
			if(json.status=='1'){
				Plugins.setWaitTipsMsg({ content:'操作成功',timeout:1000,callback:function(){
				   location.href="<?php echo U('Admin/Role/index');?>";
				}});
			}else{
				Plugins.closeWindow();
				Plugins.Tips({title:'信息提示',icon:'error',content:'操作失败!',timeout:1000});
			}
		});
   }
   function checkModel(v){
		$('.'+$(v).val()).each(function(){
			$(this).prop('checked',$(v).prop('checked'));
		})
	}
   </script>
   <body class="wst-page">
       <form name="myform" method="post" id="myform" autocomplete="off">
        <input type='hidden' id='id' value='<?php echo ($object["role_id"]); ?>'/>
        <table class="table table-hover table-striped table-bordered wst-form">
           <tr>
             <th width='120' align='right'>角色名称<font color='red'>*</font>：</th>
             <td><input type='text' id='roleName' class="form-control wst-ipt" value='<?php echo ($object["role_name"]); ?>' maxLength='25'/></td>
           </tr>
           <tr>
             <th align='right'>权限列表<font color='red'>*</font>：</th>
             <td>
             <table>
                <?php if(is_array($authinfoA)): foreach($authinfoA as $key=>$v): ?><tr>
                    <td width="150"><label><input type='checkbox' class='chk grant spgl spfl' value='<?php echo ($v["auth_id"]); ?>' <?php if(in_array(($v["auth_id"]), is_array($object["role_auth_ids"])?$object["role_auth_ids"]:explode(',',$object["role_auth_ids"]))): ?>checked<?php endif; ?>/><?php echo ($v["auth_name"]); ?></label></td>
                   <?php if(is_array($authinfoB)): foreach($authinfoB as $key=>$vv): if(($vv["auth_pid"]) == $v["auth_id"]): ?><td style="width: 100px">
                      <label><input type='checkbox' class='chk grant spgl spfl' id='spfl_00' value='<?php echo ($vv["auth_id"]); ?>'<?php if(in_array(($vv["auth_id"]), is_array($object["role_auth_ids"])?$object["role_auth_ids"]:explode(',',$object["role_auth_ids"]))): ?>checked<?php endif; ?>/><?php echo ($vv["auth_name"]); ?></label>
                   </td><?php endif; endforeach; endif; ?>
                </tr><?php endforeach; endif; ?>
             </table>
             </td>
           </tr>
           <tr>
             <td colspan='2' style='padding-left:250px;'>
                 <button type="submit" class="btn btn-success">保&nbsp;存</button>
                 <button type="button" class="btn btn-primary" onclick='javascript:location.href="<?php echo U('Admin/Role/index');?>"'>返&nbsp;回</button>
             </td>
           </tr>
        </table>
       </form>
   </body>
</html>