<?php
 namespace Admin\Controller;
 use Think\Controller;

 /**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 权限控制器
 */
class RoleController extends Controller {
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
//		$this->isLogin();
	    $m = D("Role");
    	$object = array();
    	if(I('id',0)>0){
//    		$this->checkPrivelege('jsgl_02');
    		$object = $m->get();
    	}else{
//    		$this->checkPrivelege('jsgl_01');
    		$object = $m->getModel();
    	}
    	$this->assign('object',$object);
        $authinfoA = D("Auth")->where(array("auth_level"=>0))->select();
        $this->assign("authinfoA",$authinfoA);
        $authinfoB = D("Auth")->where(array("auth_level"=>1))->select();
        $this->assign("authinfoB",$authinfoB);
		$this->view->display('/role/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
//		$this->isLogin();
		$m = D('Admin/Role');
    	$rs = array();
    	if(I('id',0)>0){
//    		$this->checkPrivelege('jsgl_02');
    		$rs = $m->edit();
    	}else{
//    		$this->checkPrivelege('jsgl_01');
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		$this->isLogin();
		$this->checkPrivelege('jsgl_03');
		$m = D('Admin/Roles');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
//		$this->isLogin();
//		$this->checkPrivelege('jsgl_00');
		$m = D('Admin/Role');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	$this->assign('Page',$page);
        $this->display("/role/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	$this->isLogin();
		$m = D('Admin/Roles');
		$list = $m->queryList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
    public function getTree2($data, $parentId=0)
    {
        $arr = array();
        foreach($data as $k=>$v)
        {
            if($v['auth_pid']==$parentId )
            {
                //再查找该分类下是否还有子分类
                $v['child'] = $this->getTree($data, $v['auth_id']);
                //统计child
                $v['childNum'] = count($v['child']);
                //将找到的分类放回该数组中
                $arr[]=$v;
            }
        }
        return $arr;
    }
};
?>