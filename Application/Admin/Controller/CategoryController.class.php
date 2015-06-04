<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller {
	public function index($backurl='.')
	{
		//$currentUser=$this->userInit();
		
		$Category=M('Category');
		$selectCategory=$Category->order('id')->select();
		

		$category=M('category');
		foreach ($selectCategory as &$value) {
			$t=$category->where(array('id'=>$value['category']))->find();
			$value['category_name']=$t['name'];
		}
		$this->assign('CategoryList',$selectCategory);
		$this->display();
	}
	public function del()
	{
		//$currentUser=$this->userInit();
		$Category=M('Category');
		$Category->where(array('id'=>I('id')))->delete();//删除商品
		
		$selectCategory=$Category->order('id')->select();

		$category=M('category');
		foreach ($selectCategory as &$value) {
			$t=$category->where(array('id'=>$value['category']))->find();
			$value['category_name']=$t['name'];
		}
		$this->assign('CategoryList',$selectCategory);
		$this->display('index');
	}
	public function edit()
	{
		//$currentUser=$this->userInit();
		$Category=M('Category');
		$currentCategory=$Category->where(array('id'=>I('id')))->find();

		$category=M('category');
		$selectCategory=$category->order('id')->select();
		
		$this->assign('categoryList',$selectCategory);
		$this->assign('id',$currentCategory['id']);
		$this->assign('name',$currentCategory['name']);
		$this->assign('category',$currentCategory['category']);
		$this->assign('price',$currentCategory['price']);
		$this->assign('unit',$currentCategory['unit']);
		$this->display();
	}
	public function save()
	{
		//$currentUser=$this->userInit();
		
		$Category=D('Category');
		$currentCategory=$Category->where(array('id'=>I('id')))->find();
		$data=array(
			'id'=>I('id'),
			'name' =>I('name'),
			'category' =>I('category') ,
			'price' =>I('price'),
			'unit' =>I('unit'),
			'time'=>date('Y-m-d H:i:s',time())
			);
		var_dump(!empty($_FILES['pic']));
		if(isset($_FILES['pic']) && !empty($_FILES['pic']['name'])){
			$upload=new \Think\Upload();
			$upload->exts=array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
			$upload->rootPath=I('server.DOCUMENT_ROOT').constant("__ROOT__").'/Upload/';
			$info = $upload->uploadone($_FILES['pic']);
			unlink(I('server.DOCUMENT_ROOT').constant("__ROOT__").$currentCategory['pic']);
			$data['pic']='/'.constant("__ROOT__").'Upload/'.$info['savepath'].$info['savename'];
		}
		else 
		{

		}
		$Category->create($data);
		$Category->save();

		$this->redirect('index');
	}
	public function add()
	{
		//$currentUser=$this->userInit();
		if(IS_POST)
		{
			$upload=new \Think\Upload();
			$upload->exts=array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
			$upload->rootPath=I('server.DOCUMENT_ROOT').constant("__ROOT__").'/Upload/';
			$info = $upload->uploadone($_FILES['pic']);
			$Category=D('Category');
			$Category->create(array(
				'name' =>I('name'),
				'category' =>I('category') ,
				'price' =>I('price'),
				'unit' =>I('unit'),
				'time'=>date('Y-m-d H:i:s',time()),
				'pic'=>'/'.constant("__ROOT__").'Upload/'.$info['savepath'].$info['savename']
				));
			$Category->add();
			$this->redirect('index');
		}
		else 
		{
			$category=M('category');
			$selectCategory=$category->order('id')->select();
			$this->assign('categoryList',$selectCategory);
			$this->display();
		}

	}
}