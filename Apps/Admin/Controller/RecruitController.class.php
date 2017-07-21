<?php
namespace Admin\Controller;

use Think\Controller;

class RecruitController extends Controller
{
    public function showlist()
    {
        $m = D('Admin/Recruit');
//        $page = $m->queryByPage();
//        $pager = new \Think\Page($page['total'],$page['pageSize'],I());// 实例化分页类 传入总记录数和每页显示的记录数
//        $page['pager'] = $pager->show();
//        $this->assign('Page',$page);
//        $this->assign('articleTitle',I('articleTitle'));
        $info = $m->select();
        $this->assign("info",$info);
        $this->display();
    }
    /**
     * 显示商品是否显示/隐藏
     */
    public function editiIsShow(){
        $m = D('Admin/Recruit');
        $rs = $m->editiIsShow();
        $this->ajaxReturn($rs);
    }

    /**
     * 跳到新增/编辑页面
     */
    public function toEdit(){
        $m = D('Admin/Recruit');
        $object = array();
        if(I('id',0)>0){
            $object = $m->get();
        }else{
            $object = $m->getModel();
        }
        $m = D('Admin/ArticleCats');
//        $this->assign('catList',$m->getCatLists());
//        $this->assign('object',$object);
        $this->view->display('edit');
    }

    /**
     * 新增/修改操作
     */
    public function edit(){
        $m = D('Admin/Recruit');
        $rs = array();
        if(I('id',0)>0){
//            $this->checkPrivelege('wzlb_02');
            $rs = $m->edit();
        }else{
//            $this->checkPrivelege('wzlb_01');
            $rs = $m->insert();
        }
        $this->ajaxReturn($rs);
    }

    /**
     * 删除
     */
    public function del(){
//        $this->isLogin();
//        $this->checkPrivelege('wzlb_03');
        $m = D('Admin/Recruit');
        $rs = $m->del();
        $this->ajaxReturn($rs);
    }
}