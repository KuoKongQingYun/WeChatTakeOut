<?php
namespace Admin\Controller;
use Think\Controller;
class ItemController extends Controller {
	private function auth()
	{
		$admin=M('admin');
		$currentAdmin=$admin->where(array('id'=>I('cookie.adminID')))->find();
		if($currentAdmin['auth']=='' || $currentAdmin['auth']!=I('cookie.auth'))
		{
			$this->redirect('Login/index');
		}
	}
    public function index(){
    	$this->auth();
		
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
		$this->auth();
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
		$this->auth();
		$item=M('item');
		$currentItem=$item->where(array('id'=>I('id')))->find();

		$category=M('category');
		$selectCategory=$category->order('id')->select();
		
		$this->assign('categoryList',$selectCategory);
		$this->assign('id',$currentItem['id']);
		$this->assign('name',$currentItem['name']);
		$this->assign('category',$currentItem['category']);
		$this->assign('price',$currentItem['price']);
		$this->assign('unit',$currentItem['unit']);
		$this->display();
	}
	public function save()
	{
		$this->auth();
		$item=D('item');
		$currentItem=$item->where(array('id'=>I('id')))->find();
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
			unlink(I('server.DOCUMENT_ROOT').constant("__ROOT__").$currentItem['pic']);
			$data['pic']='/'.constant("__ROOT__").'Upload/'.$info['savepath'].$info['savename'];
		}
		$item->create($data);
		$item->save();

		$this->redirect('index');
	}
	public function add()
	{
		$this->auth();
		if(IS_POST)
		{
			$upload=new \Think\Upload();
			$upload->exts=array('jpg', 'gif', 'png', 'jpeg','bmp');// 设置附件上传类型
			$upload->rootPath=I('server.DOCUMENT_ROOT').constant("__ROOT__").'/Upload/';
			$info = $upload->uploadone($_FILES['pic']);
			$item=D('item');
			$item->create(array(
				'name' =>I('name'),
				'category' =>I('category') ,
				'price' =>I('price'),
				'unit' =>I('unit'),
				'time'=>date('Y-m-d H:i:s',time()),
				'pic'=>'/'.constant("__ROOT__").'Upload/'.$info['savepath'].$info['savename']
				));
			$item->add();
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