<?php
namespace Home\Controller;
use Think\Controller;
class CategoryController extends Controller {
	private function userInit(){
		$wxid = I('get.wxid');
		$wxid = $wxid==""?I('cookie.wxid'):$wxid;
		if($wxid=="")
		{
			exit("请从微信访问！");
		}
		else
		{
			cookie('wxid',$wxid);
			$user=M('user');
			$selectUser=$user->where(array("wxid"=>$wxid))->select();
			if(count($selectUser)==0)
			{
				$this->redirect('/Index/user');
			}
			return $selectUser[0];
		}
	}
	private function categoryInit(){
		
		$category=M('category');
		$selectCategory=$category->select();
		$this->assign('categoryList',$selectCategory);
		return $selectCategory;
	}
	public function index(){
		$this->categoryInit();
		$currentUser=$this->userInit();
		if(I('get.id')=="")
		{
			$this->redirect('index');
		}
		$category=M('category');
		$currentCategory=$category->where(array('id'=>I('get.id')))->find();
		$this->assign('categoryname',$currentCategory['name']);

		$item=M('item');
		$selectItem=$item->where(array('category'=>I('get.id')))->select();
		$this->assign('itemList',$selectItem);

		$this->display();
	}
}