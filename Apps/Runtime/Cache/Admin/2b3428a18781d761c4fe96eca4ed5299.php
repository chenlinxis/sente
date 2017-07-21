<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo ($CONF['mallTitle']); ?>后台管理中心</title>
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
      <style type="text/css">
		#preview{border:1px solid #cccccc; background:#CCC;color:#fff; padding:5px; display:none; position:absolute;}
	  </style>
   </head>
   <script>
   function batchChangeStatus(v)
   {
   	   var ids = [];
	   $('.chk').each(function(){
		   if($(this).prop('checked'))ids.push($(this).val());
	   })
	   Plugins.waitTips({title:'信息提示',content:'正在操作，请稍后...'});
	   $.post("<?php echo U('Admin/Goods/changeGoodsStatus');?>",{id:ids.join(','),status:v},function(data,textStatus){
				var json = WST.toJson(data);
				if(json.status=='1'){
					Plugins.setWaitTipsMsg({content:'操作成功',timeout:1000,callback:function(){
					    location.reload();
					}});
				}else{
					Plugins.closeWindow();
					Plugins.Tips({title:'信息提示',icon:'error',content:'操作失败!',timeout:1000});
				
				}
	   });
   }

   function changeStatus(id,v){
	   Plugins.waitTips({title:'信息提示',content:'正在操作，请稍后...'});
	   $.post("<?php echo U('Admin/Goods/changeGoodsStatus');?>",{id:id,status:v},function(data,textStatus){
				var json = WST.toJson(data);
				if(json.status=='1'){
					Plugins.setWaitTipsMsg({content:'操作成功',timeout:1000,callback:function(){
					    location.reload();
					}});
				}else{
					
					Plugins.Tips({title:'信息提示',icon:'error',content:'操作失败!',timeout:1000});
				
				}
	   });
   }
   function batchRecom(v){
	   var ids = [];
	   $('.chk').each(function(){
		   if($(this).prop('checked')) {
		       ids.push($(this).val());
           }
	   })
	   Plugins.waitTips({title:'信息提示',content:'正在操作，请稍后...'});
	   $.post("<?php echo U('Admin/Goods/changeRecomStatus');?>",{id:ids.join(','),status:v},function(data,textStatus){
				var json = WST.toJson(data);
				if(json.status=='1'){
					Plugins.setWaitTipsMsg({content:'操作成功',timeout:1000,callback:function(){
					    location.reload();
					}});
				}else{
					Plugins.closeWindow();
					Plugins.Tips({title:'信息提示',icon:'error',content:'操作失败!',timeout:1000});
				
				}
	   });
   }
   function checkAll(v){
	   $('.chk').each(function(){
		   $(this).prop('checked',v);
	   })
   }
   $.fn.imagePreview = function(options){
		var defaults = {}; 
		var opts = $.extend(defaults, options);
		var t = this;
		xOffset = 5;
		yOffset = 20;
		if(!$('#preview')[0])$("body").append("<div id='preview'><img width='200' src=''/></div>");
		$(this).hover(function(e){
			   $('#preview img').attr('src',"/Public/Uploads//"+$(this).attr('img'));
			   $("#preview").css("top",(e.pageY - xOffset) + "px").css("left",(e.pageX + yOffset) + "px").show();      
		  },
		  function(){
			$("#preview").hide();
		}); 
		$(this).mousemove(function(e){
			   $("#preview").css("top",(e.pageY - xOffset) + "px").css("left",(e.pageX + yOffset) + "px");
		});
	}
   function getAreaList(objId,parentId,t,id){
	   var params = {};
	   params.parentId = parentId;
	   $('#'+objId).empty();
	   if(t<1){
		   $('#areaId2').html('<option value="">请选择</option>');
		   if(parentId==0)return;
	   }
	   var html = [];
	   $.post("<?php echo U('Admin/Areas/queryByList');?>",params,function(data,textStatus){
		    html.push('<option value="">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list.length>0){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.areaId+'" '+((id==opts.areaId)?'selected':'')+'>'+opts.areaName+'</option>');
				}
			}
			$('#'+objId).html(html.join(''));
	   });
   }
   function getCatList(objId,parentId,t,id){
	   var params = {};
	   params.id = parentId;
	   $('#'+objId).empty();
	   if(t<1){
		   $('#goodsCatId3').empty();
		   $('#goodsCatId3').html('<option value="0">请选择</option>');
		   if(parentId==0){
			   $('#goodsCatId2').html('<option value="0">请选择</option>');
			   return;
		   }
	   }
	   var html = [];
	   $.post("<?php echo U('Home/GoodsCats/queryByList');?>",params,function(data,textStatus){
		    html.push('<option value="0">请选择</option>');
			var json = WST.toJson(data);
			if(json.status=='1' && json.list){
				var opts = null;
				for(var i=0;i<json.list.length;i++){
					opts = json.list[i];
					html.push('<option value="'+opts.catId+'" '+((id==opts.catId)?'selected':'')+'>'+opts.catName+'</option>');
				}
			}
			$('#'+objId).html(html.join(''));
	   });
   }
   $(document).ready(function(){
	    $('.imgPreview').imagePreview();
	    <?php if(!empty($areaId1)): ?>getAreaList("areaId2",'<?php echo ($areaId1); ?>',0,'<?php echo ($areaId2); ?>');<?php endif; ?>
		<?php if($goodsCatId1 != 0 ): ?>getCatList("goodsCatId2",<?php echo ($goodsCatId1); ?>,0,<?php echo ($goodsCatId2); ?>);<?php endif; ?>
		<?php if($goodsCatId2 != 0 ): ?>getCatList("goodsCatId3",<?php echo ($goodsCatId2); ?>,1,<?php echo ($goodsCatId3); ?>);<?php endif; ?>
   });
   </script>
   <body class='wst-page'>

    <form method='post' action='<?php echo U("Admin/Goods/index");?>' autocomplete="off">
   <div class='wst-tbar'>
       商品：<input type='text' id='goodsName' name='goodsName' value='<?php echo ($goodsName); ?>'/> 
     商品类型：<select id='isAdminBest' name='isAdminBest'>
       <option value='-1'>全部</option>
    <option value='1' <?php if($isAdminBest == 1): ?>selected<?php endif; ?>>精品</option>
    <option value='0' <?php if($isAdminBest == 0): ?>selected<?php endif; ?>>非精品</option>
  </select>
  <select id='isAdminRecom' name='isAdminRecom'>
    <option value='-1'>全部</option>
    <option value='1' <?php if($isAdminRecom == 1): ?>selected<?php endif; ?>>推荐</option>
    <option value='0' <?php if($isAdminRecom == 0): ?>selected<?php endif; ?>>非推荐</option>
  </select>
  <button type="submit" class="btn btn-primary glyphicon glyphicon-search">查询</button>
       <a class="btn btn-success glyphicon glyphicon-plus" href="<?php echo U('Admin/Goods/toEdit');?>" style='float:right'>添加商品</a>
   </div>
       </form>
       <div class='wst-body'>
        <div class='wst-tbar'> 
        <button type="button" class="btn btn-primary glyphicon" onclick='javascript:batchRecom(1)'>设置推荐</button>
        <button type="button" class="btn btn-primary glyphicon" onclick='javascript:batchRecom(0)'>取消推荐</button>
        <button type="button" class="btn btn-primary glyphicon" onclick='javascript:batchChangeStatus(0)'>批量禁售</button>
        </div>
        <table class="table table-hover table-striped table-bordered wst-list">
           <thead>
             <tr>
               <th width='2'><input type='checkbox' name='chk' onclick='javascript:WST.checkChks(this,".chk")'/></th>


               <th width='180'>商品名称</th>
               <th width='60'>商品编号</th>
               <th width='40'>价格</th>
               <th width='100'>商品类型</th>
               <th width='25'>推荐</th>
               <th width='25'>销量</th>
               <th width='80'>操作</th>
             </tr>
           </thead>
           <tbody>
            <?php if(is_array($goodsinfo)): $i = 0; $__LIST__ = $goodsinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr >
               <td><input type='checkbox' class='chk' name='chk_<?php echo ($vo['goods_id']); ?>' value='<?php echo ($vo['goods_id']); ?>'/></td>


               <td img='<?php echo ($vo['goods_big_logo']); ?>' class='imgPreview'>
               <img src='/Public/Uploads//<?php echo ($vo['goods_big_logo']); ?>' width='50'/>
               <?php echo ($vo['goods_name']); ?>
               </td>
                 <td><?php echo ($vo['goodsSn']); ?>&nbsp;</td>
                 <td><?php echo ($vo['goods_price']); ?>&nbsp;</td>
               <td><?php echo ($vo['cat_id']); ?>&nbsp;</td>
               <td>
               <?php if($vo['is_rec']==1 ): ?><span class='label label-success'>推荐</span><?php endif; ?>
               </td>
               <td><?php echo ($vo['saleCount']); ?></td>
               <td>
               <a class="btn btn-primary glyphicon" href='<?php echo U("Admin/Goods/toView",array("id"=>$vo["goodsId"]));?>'>查看</a> 
               <button type="button" class="btn btn-danger glyphicon glyphicon-pencil" onclick="javascript:changeStatus(<?php echo ($vo['goods_id']); ?>,0)">禁售</button>&nbsp;
               </td>
             </tr><?php endforeach; endif; else: echo "" ;endif; ?>
             <tr>
                <td colspan='10' align='center'><?php echo ($Page['pager']); ?></td>
             </tr>
           </tbody>
        </table>
       </div>
   </body>
</html>