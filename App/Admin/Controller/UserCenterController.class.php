<?php
/*
 * 个人中心控制器 Auth : Ghj Time : 2016年01月05日 QQ : 912524639 Email : 912524639@qq.com Site : http://guanblog.sinaapp.com/
 */
namespace Admin\Controller;

class UserCenterController extends AdminCoreController {
	public $Model = null;
	protected function _initialize() {
		parent::_initialize ();
		$this->Model = D ( 'Users' );
	}
	
	/*
	 * 列表(默认首页) Auth : Ghj Time : 2016年01月05日
	 */
	public function index() {
		// 基本资料
		$uid = session ( C ( 'AUTH_KEY' ) );
		$data = $this->Model->where ( 'user_id=' . $uid )->join ( 'left join ecs_departments on ecs_users.department_id=ecs_departments.id' )->find ();
		$this->assign ( 'data', $data );
		$this->display ();
	}
	
	// 修改密码
	public function modifyPwd() {
		if (IS_POST) {
			$uid = session ( C ( 'AUTH_KEY' ) );
			$data ['password'] = md5 ( I ( 'post.password' ) );
			$data ['pwd1'] = md5 ( I ( 'post.pwd1' ) );
			$data ['pwd2'] = md5 ( I ( 'post.pwd2' ) );
			$result = $this->Model->where ( 'user_id=' . $uid )->find ();
			if ($result ['password'] == $data ['password']) {
				if ($data ['pwd1'] == $data ['pwd2']) {
					$info = $this->Model->where ( 'user_id=' . $uid )->setField ( 'password', $data ['pwd2'] );
					if ($info) {
						$this->error ( '恭喜，修改成功' );
						// echo "<script>alert('恭喜，修改成功');window.history.back();</script>";
					}
				} else {
					$this->error ( '两次输入的新密码不同，请重新输入' );
				}
			} else {
				$this->error ( '旧密码不正确，请重新输入' );
			}
		}
	}
	
	// 信息修改
	public function update() {
		if (IS_POST) {
			$uid = session ( C ( 'AUTH_KEY' ) );
			$post_data = I ( 'post.' );
			$data = $this->Model->create ( $post_data );
			if ($data) {
				$result = $this->Model->where ( array (
						'user_id' => $uid 
				) )->save ( $data );
				// var_dump($result);exit();
				if ($result) {
					action_log ( 'Edit_Usercenter', 'Users', $post_data ['user_id'] );
					$this->success ( "操作成功！" );
				} else {
					$error = $this->Model->getError ();
					$this->error ( $error ? $error : "操作失败！" );
				}
			} else {
				$error = $this->Model->getError ();
				$this->error ( $error ? $error : "操作失败！" );
			}
		} else {
			$_info = I ( 'get.' );
			$_info = $this->Model->where ( array (
					'id' => $_info ['id'] 
			) )->find ();
			$this->assign ( '_info', $_info );
			$this->display ();
		}
	}
	public function check() {
		$post_data = I ( 'post.' );
		$str = array ();
		$result = $this->Model->where ( array (
				'user_name' => $post_data ['user_name'] 
		) )->select ();
		if ($result) {
			if ($result ['0'] ['user_id'] == $post_data ['user_id']) {
				$str ['dat'] = '1'; // 用户名没变化
			} else {
				$str ['dat'] = '2'; // 用户名已存在
			}
		} else {
			$str ['dat'] = '3'; // 用户名可以使用
		}
		$this->ajaxReturn ( $str, 'json' );
	}
	
	// 订单管理
	public function orderlist() {
		if (IS_POST) {
			$pagenum = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
			$rowsnum = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 10;
			$order = D ( 'order_info' );
			$total = $order->count (); // 计算总数
			$userlist = array ();
			$userlist = $order->limit ( ($pagenum - 1) * $rowsnum . ',' . $rowsnum )->order ( 'order_id asc' )->select ();
			foreach ( $userlist as $key => $value ) {
				$userlist [$key] ['add_time'] = date ( "Y-m-d H:i", $userlist [$key] ["add_time"] );
				if ($userlist [$key] ["pay_status"] == 0) {
					$userlist [$key] ["pay_status"] = "未付款";
				} elseif ($userlist [$key] ["pay_status"] == 1) {
					$userlist [$key] ["pay_status"] = "付款中";
				} else {
					$userlist [$key] ["pay_status"] = "已付款";
				}
				
				if ($userlist [$key] ["shipping_status"] == 0) {
					$userlist [$key] ["shipping_status"] = "未发货";
				} elseif ($userlist [$key] ["shipping_status"] == 1) {
					$userlist [$key] ["shipping_status"] = "已发货";
				} elseif ($userlist [$key] ["shipping_status"] == 2) {
					$userlist [$key] ["shipping_status"] = "已收货";
				} else {
					$userlist [$key] ["shipping_status"] = "退货";
				}
				
				if ($userlist [$key] ["order_status"] == 0) {
					$userlist [$key] ["order_status"] = "未确认";
				} elseif ($userlist [$key] ["order_status"] == 1) {
					$userlist [$key] ["order_status"] = "已确认";
				} elseif ($userlist [$key] ["order_status"] == 2) {
					$userlist [$key] ["order_status"] = "已取消";
				} elseif ($userlist [$key] ["order_status"] == 3) {
					$userlist [$key] ["order_status"] = "无效";
				} elseif ($userlist [$key] ["order_status"] == 4) {
					$userlist [$key] ["order_status"] = "退货";
				} else {
					$userlist [$key] ["order_status"] = "已分单";
				}
				
				$operate_menu = '';
				
				if (Is_Auth('Admin/UserCenter/show_order')) {
					$operate_menu = $operate_menu . 
					"<a href='#' 
						onclick=\"Submit_Form('User_Form',
							  'dg','" 
							  . U ('show_order', 
							  	array ('order_id' => $userlist[$key]['order_id'] ) ) 
							  . "','','查看订单','');\">查看订单 
					</a>";
				}
				if(Is_Auth('Admin/UserCenter/group')){
					$operate_menu = $operate_menu.
					"<a href='#' 
						onclick=\"Submit_Form('User_Form',
							'dg','" 
							. U ( 'group', 
								array ('order_id' => $userlist [$key] ['order_id'] ) ) 
							. "','','用户授权','你确定要修改此用户的 用户组 ？');\">用户授权
					</a>";
				}
				$userlist [$key] ['operate'] = $operate_menu;
			}
			
			
			if ($total == 0) {
				$userlist = "";
				$this->ajaxReturn ( $userlist );
			} else {
				$data = array (
						'total' => $total,
						'rows' => $userlist 
				);
				$this->ajaxReturn ( $data );
			}
		} else {
			$this->display ( 'orderlist' );
		}
	}
	
	/**
	 * 客户管理
	 */
	public function customer() {
		$where = array ();
		if (IS_POST) {
			$params = I ( 'post.' );
			if ($params ['kehu_name'] != '') {
				$where ['kehu_name'] = array (
						'like',
						'%' . $params ['kehu_name'] . '%' 
				);
			}
			if ($params ['mobile_phone'] != '') {
				$where ['mobile_phone'] = $params ['mobile_phone'];
			}
			if ($params ['vip_number'] != '') {
				$where ['vip_number'] = $params ['vip_number'];
			}
		}
		// $uid = session (C('AUTH_KEY'));
		$data = M ( 'customer' )->where ( $where )->select ();
		$this->assign ( 'data', $data );
		$this->assign ( 'params', $params );
		$this->display ();
	}
	public function add_customer() {
		if (IS_POST) {
			$data = I ( 'post.' );
			$info = M ( 'customer' )->where ( $data )->find ();
			if (empty ( $info )) {
				$res = M ( 'customer' )->where ()->add ( $data );
				if ($res) {
					$this->success ( "添加成功！" );
					$this->assign ( 'res', $res );
				} else {
					$this->error ( "添加失败" );
				}
			} else {
				$this->error ( "该可以存在" );
			}
		}
		// $this->display ();
	}
	
	/**
	 * 查看订单
	 */
	public function order_detail() {
		$order_id = I ( 'get.order_id' );
		$order = M ( 'order_info' )->where ( 'order_id=' . $order_id )->select ();
		$this->assign ( 'order', $order );
		$this->display ();
	}
	
	public function show_order(){
			$this->display('show_order');
	}
}