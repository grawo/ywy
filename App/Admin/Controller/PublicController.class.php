<?php

namespace Admin\Controller;
use Common\Controller\CoreController;

class PublicController extends CoreController {
	
    public function login(){
        if(IS_POST){
			$data['user_name'] = I ( "post.username", "", "trim" );
			$data['password'] = md5(I ( "post.password", "", "trim" ));
			if (empty ( $data['user_name'] ) || empty ( $data['password'] )) {
				$this->error ( "用户名或者密码不能为空，请重新输入！", U ( C ( 'AUTH_USER_GATEWAY' ) ) );
			}
			/* $map = array (
					'user_name' => $username,
					'password' => $password,
					'role_range' => 1 
			); */
			
			$userinfo = M ( 'Users' )->where ( $data )->find ();
			if (!empty($userinfo)&&$userinfo['role_range']!=0) {
				session (C('AUTH_KEY'),$userinfo['user_id']);
				//var_dump($userinfo['user_id']);exit;
				session ('UserInfo',$userinfo);
				session ('last_login',$userinfo['last_login']);
				$time ['last_login'] = time ();
				M('Users')->where ( 'user_id='.$userinfo['user_id'] )->save ( $time );
				session ('ModelKey.Admin',1);
				action_log('Admin_Login', 'Users', $userinfo ['user_id']);
				$this->success ( "登录成功！", U ( C ( 'AUTH_USER_INDEX' ) ) );
			} else {
				$this->error ( "用户名密码错误或者此用户无权限！", U ( C ( 'AUTH_USER_GATEWAY' ) ) );
			}
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout(){
		if (!is_login()) {
			$this->error ( "尚未登录", U ( C ( 'AUTH_USER_GATEWAY' ) ) );
		}else{
			action_log('Admin_Logout', 'Users', is_login());
			session ( null );
			if (session ( C ( 'AUTH_KEY' ) )) {
				$this->error ( "退出失败", U ( C ( 'AUTH_USER_INDEX' ) ) );
			}else{
				$this->success ( "退出成功！", U ( C ( 'AUTH_USER_GATEWAY' ) ) );
			}
		}
    }

}
