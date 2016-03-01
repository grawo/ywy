<?php 
/*
 * 用户管理控制器
 * Auth   : Ghj
 * Time   : 2015年10月10日 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Controller;

class UserController extends AdminCoreController{
	
    public $Model = null;

    protected function _initialize() {
        parent::_initialize();
        $this->Model = D('Users');
    }
	
    /* 列表(默认首页)
     * Auth   : Ghj
     * Time   : 2015年10月10日 
     **/
	public function index(){
		if(IS_POST){
			$post_data=I('post.');
			$post_data['first'] = $post_data['rows'] * ($post_data['page'] - 1);
			$map = array();
			
            $map = $this->_search();
			$total = $this->Model->where($map)->count();
			
			if($total==0){
				$_list='';
			}else{
				$_list = $this->Model->where($map)->join('left join ecs_departments on ecs_users.department_id=ecs_departments.id')->order($post_data['sort'].' '.$post_data['order'])->limit($post_data['first'].','.$post_data['rows'])->select();
				//$_list = $this->Model->where($map and $post_data['role_range']!=0)->order($post_data['sort'].' '.$post_data['order'])->limit($post_data['first'].','.$post_data['rows'])->select();
			    
			}
			foreach($_list as $doubi =>$ddb){
				
					if($ddb['role_range'] != 0){
						
						$ddb = $ddb;
					}
				
			}
			//var_dump($_list); exit();
		
            $op_status=R("Admin/Function/get_config",array("USER_STATUS_TYPE|type|title"));
                     foreach($op_status as $op_status_key=>$op_status_one){
                     	$option["status"][$op_status_one["type"]]=$op_status_one["title"];
                     }
                     
          	foreach($_list as $list_key=>$list_one){
          		//var_dump($list_one); exit();
          		
                foreach($list_one as $list_one_key=>$list_one_field){
                    if($option[$list_one_key]!=''){
                        $_list[$list_key][$list_one_key]=$option[$list_one_key][$list_one_field];
                    }
               		
                }
                $_list [$list_key]["last_login"]=date("Y-m-d H:i",$_list[$list_key]["last_login"]);
                $_list [$list_key]["reg_time"]=date("Y-m-d H:i",$_list[$list_key]["reg_time"]);
                $_list [$list_key]["last_time"]=date("Y-m-d H:i",$_list[$list_key]["last_time"]);
                switch ($_list [$list_key]["role_range"]){
                	
                	case 1: $_list [$list_key]["role_range"]="业务员";break;
                	case 2: $_list [$list_key]["role_range"]="门店店主";break;
                	case 3: $_list [$list_key]["role_range"]="供应商";break;
                	case 4: $_list [$list_key]["role_range"]="兼职业务员";break;
                	default:$_list [$list_key]["role_range"]="普通会员";break;
                }
                if($_list [$list_key]["sex"]==1){
                	$_list [$list_key]["sex"]="男";
                }else{
                	$_list [$list_key]["sex"]="女";
                }
               
				$operate_menu='';
				if(Is_Auth('Admin/User/group')){
					$operate_menu = $operate_menu."<a href='#' onclick=\"Submit_Form('User_Form','User_Data_List','" . U ( 'group', array ('user_id' => $_list [$list_key] ['user_id'] ) ) . "','','用户授权','你确定要修改此用户的 用户组 ？');\">用户授权</a>";
				}
				if(Is_Auth('Admin/User/edit')){
					$operate_menu = $operate_menu.
					"<a href='#' 
							onclick=\"Submit_Form('User_Form',
							'User_Data_List',
							'" . U ( 'edit', array ('user_id' => $_list [$list_key] ['user_id'] ) ) . "',
							'',
							'编辑数据',
							'');\">编辑
					</a>";
				}
				if(Is_Auth('Admin/User/del')){
					$operate_menu = $operate_menu."<a href='#' onclick=\"Data_Remove('" . U ( 'del', array ('user_id' => $_list [$list_key] ['user_id'] ) ) . "','User_Data_List');\">删除</a>";
				}
				$_list [$list_key] ['operate'] = $operate_menu;
            }
	
			$data = array('total'=>$total, 'rows'=>$_list);
			$this->ajaxReturn($data);
          
		}else{
        	$this->display();
		}
	}
	
	/* public function user_center(){
		$this->display();
	} */
	
    /* 搜索
     * Auth   : Ghj
     * Time   : 2015年10月10日 
     **/
	protected function _search() {
		$map = array ();
		$post_data=I('post.');
		//var_dump($_POST);exit();
		if($post_data['s_user_name']!=''){
			$map['user_name']=array('like', '%'.$post_data['s_user_name'].'%');
		}
		
		if($post_data['s_user_code']!=''){
			$map['user_code']=$post_data['s_user_code'];
		}
		
	   	if($post_data['s_status']!=''){
			$map['status']=$post_data['s_status'];
		}
		return $map;
	}
    
    /* 添加
     * Auth   : Ghj
     * Time   : 2015年10月10日 
     **/
	public function add(){
		
		if(IS_POST){
			$post_data=I('post.');
		    $post_data['password']=md5(I('password'));
			$post_data['user_name']=I('post.user_name');
			$post_data['user_code']=I('post.user_code');
		    $post_data['mobile_phone']=I('post.mobile_phone');
		    $username = '70201503';
		    $password = '13621973524';
		    $content =  "您好".$post_data['user_name']."，欢迎您加入惠顾（拓见）大家庭！您的业务员编码".$post_data['user_code'].",密码666666已生成，请登录惠顾网www.huigush.com使用。客服电话 4000210868";
		    $SMS = new \Org\Util\SendSMS();
		    //var_dump($SMS);exit();
		    $res = $SMS->sendmessage($username,$password,$post_data['mobile_phone'],$content);
		    if($res!=100){
		    	echo '发送信息失败';
		    }else{
		    	$info=$this->Model->where('user_code='.$post_data['user_code'])->find();
		    	if(empty($info)){
		    		$data=$this->Model->create($post_data);
		    		$data['reg_time']=time();
		    		if($data){
		    			$result = $this->Model->add($data);
		    			if($result){
		    				action_log('Add_User', 'Users', $result);
		    				$this->success ( "操作成功！",U('index'));
		    			}else{
		    				$error = $this->Model->getError();
		    				$this->error($error ? $error : "操作失败！");
		    			}
		    		}else{
		    			$error = $this->Model->getError();
		    			$this->error($error ? $error : "操作失败！");
		    		}
		    	}else{
		    		$error = $this->Model->getError();
		    		$this->error($error ? $error : "操作失败！");
		    	}
		    	
		    } 
			
		}else{
			$dep=M('Departments')->select();
			$this->assign('dep',$dep);
        	$this->display();
        	
		}
	}
	
    /* 编辑
     * Auth   : Ghj
     * Time   : 2015年10月10日 
     **/
	public function edit(){
		if(IS_POST){
			$post_data=I('post.');
            $data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->where(array('user_id'=>$post_data['user_id']))->save($data);
				if($result){
					action_log('Edit_User', 'Users', $post_data['user_id']);
					$this->success ( "操作成功！",U('index'));
				}else{
					$error = $this->Model->getError();
					$this->error($error ? $error : "操作失败！");
				}
			}else{
                $error = $this->Model->getError();
                $this->error($error ? $error : "操作失败！");
			}
		}else{
			$_info=I('get.');
			$_info = $this->Model->where(array('user_id'=>$_info['user_id']))->find();
			$this->assign('_info', $_info);
			$this->display();
		}
	}
	
    /* 删除
     * Auth   : Ghj
     * Time   : 2015年10月10日 
     **/
	public function del(){
		$id=I('get.user_id');
		empty($id)&&$this->error('参数不能为空！');
		$res=$this->Model->where('user_id='.$id)->delete();
		if(!$res){
			$this->error($this->Model->getError());
		}else{
			action_log('Del_User', 'Users', $id);
			$this->success('删除成功！');
		}
	}
	
    /* 选择用户组
     * Auth   : Ghj
     * Time   : 2015年10月09日 
     **/
	public function group(){
		if(IS_POST){
			$post_data["uid"]=I('post.user_id');
			$post_data["group"]=I("post.group");
			foreach($post_data["group"] as $group_key=>$group_one){
				$data_ls=D('AuthGroupAccess')->create(array('uid'=>$post_data["uid"],'group_id'=>$group_one));
				$data[]=$data_ls;
			}
			D('AuthGroupAccess')->where(array('uid'=>$post_data["uid"]))->delete();
			if(count($data)>0){
				$result = D('AuthGroupAccess')->addAll($data);
				if($result){
					action_log('User_Group', 'Users', $post_data['user_id']);
					$this->success ( "操作成功！");
				}else{
					$error = D('AuthGroupAccess')->getError();
					$this->error($error ? $error : "操作失败！");
				}
			}else{
				$this->success ( "操作成功！");
			}
		}else{
			$_info=I('get.');
			$group_ids = D('AuthGroupAccess')->where(array('uid'=>$_info['user_id']))->getField('group_id',true);
			$_group_id=implode(",",$group_ids); 
			$this->assign('_info', $_info);
			$this->assign('_group_id', $_group_id);
        	$this->display();
		}
	}
	//区号查询
	public function querycode(){
		$id = I('post.id');
		$data = D('departments');
		$code=mt_rand(1000, 9999).'88';
		$this->assign('code',$code);
		$str = $data->where('id='.$id)->find();
		$str = $str['note'].$code;
		$this->ajaxReturn($str,'json');
	} 
}