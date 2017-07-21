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
      <script src="/Public/plugins/layer/layer.min.js"></script>
      <script src="/Public/plugins/plugins/plugins.js"></script>
   </head>
   <style>
   *{box-sizing:content-box;}
   </style>
   <script>
   function handle(url){
	   Plugins.Modal({url:url,title:'提现处理',width:600});
   }
   </script>
   <body class='wst-page'>
     <form action='<?php echo U('Admin/CashDraws/index');?>' method='post'>
       <div class='wst-tbar' style='height:25px;'>
       <div style='float:left;'>
                      会员类型：<select name='targetType'>
				 <option value='-1'>全部</option>
				 <option value='0' <?php if($targetType == 0 ): ?>selected<?php endif; ?>>普通会员</option>
				 <option value='1' <?php if($targetType == 1 ): ?>selected<?php endif; ?>>店铺会员</option>
				</select>
	         时间：<input type='text' id='startDate' class='laydate-icon' name='startDate' value='<?php echo ($startDate); ?>' style='width:100px' placeholder='开始日期' onclick='laydate({format: "YYYY-MM-DD"})'/>
           <input type='text' id='endDate' class='laydate-icon' name='endDate' value='<?php echo ($endDate); ?>' style='width:100px' placeholder='结束日期' onclick='laydate({format: "YYYY-MM-DD"})'/>
                     状态：<select name='cashSatus'>
               <option value='-1'>全部</option>
			   <option value='0' <?php if($cashSatus == 0 ): ?>selected<?php endif; ?>>待处理</option>
			   <option value='1' <?php if($cashSatus == 1 ): ?>selected<?php endif; ?>>已处理</option>
           </select>
             <button type="submit" class="btn btn-primary glyphicon glyphicon-search">查询</button>       
         </div>
       </div>
       </form>
       <div class="wst-body"> 
        <table class="table table-hover table-striped table-bordered wst-list">
           <thead>
             <tr>
               <th width='10'>&nbsp;</th>
			   <th width='100'>提现人</th>
			   <th width='60'>提现金额</th>
			   <th width='260'>提现账号</th>
			   <th width='120'>持有人</th>
			   <th width='*'>备注</th>
			   <th width='140'>时间</th>
			   <th width='60'>状态</th>
               <th width='60'>操作</th>
             </tr>
           </thead>
           <tbody>
            <?php if(is_array($Page['root'])): $i = 0; $__LIST__ = $Page['root'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
               <td><?php echo ($i); ?></td>
               <td nowrap><?php echo ($vo['targetName']); ?></td>
               <td><?php echo ($vo['money']); ?></td>
               <td>【<?php if($vo['accType'] == 1): ?>支付宝<?php else: ?>银行卡<?php endif; ?>】<?php if($vo['accType'] == 3): echo ($vo['accTarget']); endif; if($vo['accType'] == 3): endif; echo ($vo['accNo']); ?></td>
               <td><?php echo ($vo['accUser']); ?></td>
               <td><?php echo ($vo['cashRemarks']); ?></td>
               <td><?php echo ($vo['createTime']); ?></td>
               <td><?php if($vo['cashSatus'] == 1): ?>已处理<?php else: ?>待处理<?php endif; ?></td>
               <td>
               <a class="btn btn-default glyphicon glyphicon-pencil" href="javascript:handle('<?php echo U('Admin/CashDraws/toHandle',array('id'=>$vo['cashId']));?>')">处理</a>
               </td>
             </tr><?php endforeach; endif; else: echo "" ;endif; ?>
             <tr>
                <td colspan='9' align='center'><?php echo ($Page['pager']); ?></td>
             </tr>
           </tbody>
        </table>
       </div>
   </body>
</html>