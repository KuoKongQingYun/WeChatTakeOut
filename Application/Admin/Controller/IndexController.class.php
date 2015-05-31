<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$user=M('user');
    	$order=M('order');
    	$item=M('item');
    	$this->assign('ItemCount',$item->Count());
    	$this->assign('OrderCount',$order->Count());
    	$this->assign('UserCount',$user->Count());
        $this->display();
    }
}