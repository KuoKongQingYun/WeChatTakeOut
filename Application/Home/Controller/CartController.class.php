<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller {
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
				$this->redirect('User/index');
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
		$userName=$currentUser['name'];
		$cart=M('cart');
		$selectCart=$cart->where(array('user_id'=>$currentUser['id']))->select();
		foreach ($selectCart as &$value) {
			$item=M('item');
			$findItem = $item->where(array('id'=>$value['item_id']))->find();
			$value['name'] = $findItem['name'];
			$value['price'] = $findItem['price'];
			$value['unit'] = $findItem['unit'];
		}
		$this->assign('itemList',$selectCart);
		$this->display('index');
	}
	public function add(){
		$this->categoryInit();
		$currentUser=$this->userInit();

		$cart=M('cart');
		$cart->create(array('user_id'=>$currentUser['id'],'item_id'=>I('id')));
		$cart->add();
		$selectCart=$cart->where(array('user_id'=>$currentUser['id']))->select();
		foreach ($selectCart as &$value) {
			$item=M('item');
			$findItem = $item->where(array('id'=>$value['item_id']))->find();
			$value['name'] = $findItem['name'];
			$value['price'] = $findItem['price'];
			$value['unit'] = $findItem['unit'];
		}
		$this->assign('success','添加购物车成功，您可以回到商品列表继续选购，也可以在此结账。');
		$this->assign('itemList',$selectCart);
		$this->display('index');
	}
	public function del(){
		$this->categoryInit();
		$currentUser=$this->userInit();

		$cart=M('cart');
		$cart->create(array('user_id'=>$currentUser['id'],'id'=>I('id')));
		$cart->delete();
		$selectCart=$cart->where(array('user_id'=>$currentUser['id']))->select();
		foreach ($selectCart as &$value) {
			$item=M('item');
			$findItem = $item->where(array('id'=>$value['item_id']))->find();
			$value['name'] = $findItem['name'];
			$value['price'] = $findItem['price'];
			$value['unit'] = $findItem['unit'];
		}
		$this->assign('itemList',$selectCart);
		$this->display('index');
	}
	public function checkout(){
		$this->categoryInit();
		$currentUser=$this->userInit();

		$cart=M('cart');
		$selectCart=$cart->where(array('user_id'=>$currentUser['id']))->select();

		$content=array();
		$item=M('item');
		foreach ($selectCart as &$value) {
			$findItem = $item->where(array('id'=>$value['item_id']))->find();
			$value['name'] = $findItem['name'];
			array_push($content,$findItem['name'] );
			$value['price'] = $findItem['price'];
			$value['unit'] = $findItem['unit'];
		}
		$this->assign('itemList',$selectCart);

		$order=M('order');
		$resualt=$order->add(array('user_id'=>$currentUser['id'],'content'=>implode(',',$content),'status'=>0));
		$cart->where(array('user_id'=>$currentUser['id']))->delete();
		$this->assign('name',$currentUser['name']);
		$this->assign('phone',$currentUser['phone']);
		$this->assign('address',$currentUser['address']);
		$this->display();
	}
}