<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model {
	protected $_validate = array(
	array('username','require','请输入用户名！',1),
	array('password','require','请输入密码！',1)
	);
}