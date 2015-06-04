<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller {
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
		
		$category=M('category');
		$selectCategory=$category->order('id')->select();
		
		$this->assign('categoryList',$selectCategory);
		$this->display();
	}
	public function del()
	{
		$this->auth();

		$category=M('category');
		$category->where(array('id'=>I('id')))->delete();//删除栏目
		
		$selectCategory=$category->order('id')->select();

		$item=M('item');
		$item->where(array('category'=>I('id')))->field('category')->save(array('category'=>'0'));//将删除分类的商品分类设置为未分组
		$this->redirect('index');
	}
	public function edit()
	{
		$this->auth();

		$category=M('category');
		$currentCategory=$category->where(array('id'=>I('id')))->find();

		$category=M('category');
		$selectCategory=$category->order('id')->select();
		
		$this->assign('categoryList',$selectCategory);
		$this->assign('id',$currentCategory['id']);
		$this->assign('name',$currentCategory['name']);
		$this->display();
	}
	public function save()
	{
		$this->auth();
		
		$category=D('category');
		$currentCategory=$category->where(array('id'=>I('id')))->find();
		$data=array(
			'id'=>I('id'),
			'name' =>I('name'),
			'category' =>I('category') ,
			'price' =>I('price'),
			'unit' =>I('unit'),
			'time'=>date('Y-m-d H:i:s',time())
			);
		$Category->create($data);
		$Category->save();

		$this->redirect('index');
	}
	public function add()
	{
		$this->auth();

		if(IS_POST)
		{
			$Category=D('Category');
			$Category->create(array(
				'name' =>I('name'),
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