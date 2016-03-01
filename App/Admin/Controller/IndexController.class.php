<?php
namespace Admin\Controller;

class IndexController extends AdminCoreController {
    public function index(){
		$this->assign ( 'AdminMenu', $this->get_menu());
		$UserCount=array(rand(10,100),rand(10,100),rand(10,100),rand(10,100));
		
		//读取业务员数据
		$User = M('Users'); // 实例化User对象
		$uid = session (C('AUTH_KEY'));
		$list = $User->where('user_id='.$uid)->find();// 查询满足要求的总记录数
		//登陆时间
		$list['last_login'] = date('Y-m-d H:i:s',$list['last_login']);
		$this->assign('list',$list);// 赋值数据集
		
        $this->assign('UserCount', $UserCount);
		$this->display(); // 输出模板
    }
	
    
    /* @name:menu
     * @title:导航菜单
     * @type:1
     */
    public function menu(){
		$pid=I('get.pid',0);
		$AdminMenu = $this->get_menu();
		$this->assign ( 'LeftMenu', $AdminMenu[$pid]['children']);
		$this->display ('menu_'.C('LEFT_MENU_STYLE'));
    }
	
    /* @name:cache
     * @title:缓存
     * @type:1
     */
    public function cache(){
		D('Config')->cache();
		D('Action')->cache();
		D('ActionLog')->cache();
		$this->success('缓存更新成功！',U('Admin/Index/Index'));
    }
    
   
}