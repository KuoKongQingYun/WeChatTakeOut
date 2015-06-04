<?php
namespace Admin\Controller;
use Think\Controller;
class ItemController extends Controller {
	public function index($backurl='.')
	{
		//$currentUser=$this->userInit();
		
		$item=M('item');
		$selectItem=$item->order('id')->select();
		

		$category=M('category');
		foreach ($selectItem as &$value) {
			$t=$category->where(array('id'=>$value['category']))->find();
			$value['category_name']=$t['name'];
		}
		$this->assign('itemList',$selectItem);
		$this->display();
	}
	public function del()
	{
		//$currentUser=$this->userInit();
		$item=M('item');
		$item->where(array('id'=>I('id')))->delete();//删除商品
		
		$selectItem=$item->order('id')->select();

		$category=M('category');
		foreach ($selectItem as &$value) {
			$t=$category->where(array('id'=>$value['category']))->find();
			$value['category_name']=$t['name'];
		}
		$this->assign('itemList',$selectItem);
		$this->display('index');
	}
	public function edit()
	{
		//$currentUser=$this->userInit();
		$item=M('item');
		$currentItem=$item->where(array('id'=>I('id')))->find();

		$category=M('category');
		$selectCategory=$category->order('id')->select();
		
		$this->assign('categoryList',$selectCategory);
		$this->assign('id',$currentItem['id']);
		$this->assign('name',$currentItem['name']);
		$this->assign('category',$currentItem['category']);
		$this->assign('unit',$currentItem['unit']);
		$this->display();
	}
	public function save()
	{
		$upload=new \Think\Upload();
		$upload->exts=array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
		$upload->savePath  =      '__ROOT__/Uploads/'; // 设置附件上传目录
		$user->create(array('id'=>I('id'),'name' =>I('name'),'category' =>I('category') ,'address' =>I('address'),'wxid' =>$wxid));
		//$currentUser=$this->userInit();

	}
}