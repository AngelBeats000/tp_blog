<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize()
    {
    	$this->right();
    	$cateres=db('cate')->order('id desc')->select();
    	$this->assign('cateres',$cateres);
    }

    public function right(){
    	$clickres=db('article')->order('click desc')->limit(4)->select();
    	$tjres=db('article')->where('state','=',1)->order('click desc')->limit(4)->select();
    	$this->assign(array(
    			'clickres'=>$clickres,
    			'tjres'=>$tjres
    	));
    }

}
