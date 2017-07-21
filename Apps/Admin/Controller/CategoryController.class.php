<?php
namespace Admin\Controller;

use Think\Controller;

class CategoryController extends Controller
{
    public function showlist()
    {
//        $this->checkPrivelege('spfl_00');
        $m = D('Category');
        $list = $m->getCatAndChild();
        $this->assign('List',$list);
        $this->display();
    }
    public function edit()
    {
            $m = D('Category');
            $rs = array();
            if(I('id',0)>0){
                $rs = $m->edit();
            }else{
                $rs = $m->insert();
            }
            $this->ajaxReturn($rs);
    }
    public function upd()
    {
        $this->display();
    }

    /**
     * 修改名称
     */
    public function editName(){
        $m = D('Admin/Category');
        $rs = array('status'=>-1);
        if(I('id',0)>0){
            $rs = $m->editName();
        }
        $this->ajaxReturn($rs);
    }
    /**
     * 跳到新增/编辑页面
     */
    public function toEdit(){
        $m = D('Admin/Category');
        $object = array();
        if(I('id',0)>0){
            $object = $m->get(I('id',0));
        }else{
            if(I('pid',0)>0){
                $object = $m->get(I('pid',0));
                $object['pid'] = $object['cat_id'];
                $object['cat_name'] = '';
                $object['cat_sort'] = 0;
                $object['cat_id'] = 0;
            }else{
                $object = $m->getModel();
            }
        }
        $this->assign('object',$object);
        $this->view->display('upd');
    }
    /**
     * 显示商品是否显示/隐藏
     */
    public function editiIsShow(){
//        $this->isLogin();
//        $this->checkPrivelege('spfl_02');
        $m = D('Admin/Category');
        $rs = $m->editiIsShow();
        $this->ajaxReturn($rs);
    }
    /**
     * 是否推荐
     */
    public function editIsFloor()
    {
//        $this->isLogin();
        $m = D('Admin/Category');
        $rs = $m->editIsFloor();
        $this->ajaxReturn($rs);
    }
}