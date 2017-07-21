<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class LoginController extends Controller
{
    public function login()
    {
        if(IS_POST){

        }else{
            $this->display();
        }
    }
    public function getVerify()
    {
        $config = array(
            "length" => 4,
            'fontSize'  =>  15,
            'fontttf'   =>  '4.ttf',
        );
        $very = new Verify($config);
        $very->entry();
    }
}