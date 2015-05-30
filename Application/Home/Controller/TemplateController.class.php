<?php
namespace Home\Controller;
use Think\Controller;
class TemplateController extends Controller {
	private function categoryInit(){
		
		$category=M('category');
		$selectCategory=$category->select();
		$this->assign('categoryList',$selectCategory);
		return $selectCategory;
	}
	public function head(){
		$this->categoryInit();
		$this->display();
	}
	public function foot(){
		$this->display();
	}
}