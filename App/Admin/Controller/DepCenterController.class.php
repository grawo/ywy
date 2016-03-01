<?php 
/*
 * 部门管理中心控制器
 * Auth   : Ghj
 * Time   : 2016年01月11日 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Controller;

class DepCenterController extends AdminCoreController {
	
    public $Model = null;

    protected function _initialize() {
        parent::_initialize();
        $this->Model = D('Users');
    }
	
    /* 列表(默认首页)
     * Auth   : Ghj
     * Time   : 2016年01月11日 
     **/
public function index(){
		if(IS_POST){
			 $pagenum=isset($_POST['page']) ? intval($_POST['page']) : 1;
             $rowsnum=isset($_POST['rows']) ? intval($_POST['rows']) : 10;
             $User=$this->Model;
             $achieve = D('order_info');
             if(isset($_POST['searchValue']) and $_POST['searchValue']!=""){
                 $userlist=array();
                 $map[$_POST['searchKey']]=array('like',array('%'.$_POST['searchValue'].'%'));
                 if(!empty($map['reg_time'])){
                 	$map['reg_time'] = strtotime($_POST['searchValue']);
                 }
                 $total=$User->where($map)->fetchSql(true)->count();
                 
                 //var_dump($total);exit;
                 $userlist=$User->where($map)->limit(($pagenum-1)*$rowsnum.','.$rowsnum)->order('user_id asc')->select();
                 $total=$User->where($map)->count();
                 for($i=0;$i<$total;$i++){
                 	$sum_custom = $achieve->where("extension_code =".$userlist[$i]['user_code'])->count();
                 	$sale_money = $achieve->where("extension_code =".$userlist[$i]['user_code'])->sum('order_amount');
                 	$userlist[$i]['sum_custom'] = $sum_custom;
                 	$userlist[$i]['sale_money'] = $sale_money;
                 	$userlist[$i]['reg_time'] = date('Y-m-d H:i:s',$userlist[$i]['reg_time']);
                 }
                 if ($total==0){
                     $userlist="";
                     $this->ajaxReturn($userlist);
                 }else{
                 	 $data = array('total'=>$total, 'rows'=>$userlist);
                     $this->ajaxReturn($data);
                 }
             }elseif(isset($_POST['date1']) and $_POST['date1']!=""){
             	$data=I('post.');
             	$data['date1'] = strtotime($data['date1']);
             	$data['date2'] = strtotime($data['date2']);
             	$map = 'reg_time between '.$data['date1'].' and '.$data['date2'];
             	$total = $User->where($map)->count();    //计算总数
             	$userlist=array();
             	$userlist=$User->where($map)->select();
             	for($i=0;$i<$total;$i++){
             		$sum_custom = $achieve->where("extension_code =".$userlist[$i]['user_code'])->count();
             		$sale_money = $achieve->where("extension_code =".$userlist[$i]['user_code'])->sum('order_amount');
             		$userlist[$i]['sum_custom'] = $sum_custom;
             		$userlist[$i]['sale_money'] = $sale_money;
             		$userlist[$i]['reg_time'] = date('Y-m-d H:i:s',$userlist[$i]['reg_time']);
             	}
             	if ($total==0){
             		$userlist="";
             		$this->ajaxReturn($userlist);
             	}else{
             		$data = array('total'=>$total, 'rows'=>$userlist);
             		$this->ajaxReturn($data,'json');
             	}
             }else{
                 $total = $User->count();    //计算总数 
                 $userlist=array();
                 $userlist=$User->limit(($pagenum-1)*$rowsnum.','.$rowsnum)->order('user_id asc')->select();
                 for($i=0;$i<$total;$i++){
                 	$sum_custom = $achieve->where("extension_code =".$userlist[$i]['user_code'])->count();
                 	$sale_money = $achieve->where("extension_code =".$userlist[$i]['user_code'])->sum('order_amount');
                 	$userlist[$i]['sum_custom'] = $sum_custom;
                 	$userlist[$i]['sale_money'] = $sale_money;
                 	$userlist[$i]['reg_time'] = date('Y-m-d H:i:s',$userlist[$i]['reg_time']);
                 }
                 if ($total==0){
                     $userlist="";
                     $this->ajaxReturn($userlist);
                 }else{
                 	 $data = array('total'=>$total, 'rows'=>$userlist);
                     $this->ajaxReturn($data);
                 }
            }
		}else{
        	$this->display();
		}
	}
	
    /* 搜索
     * Auth   : Ghj
     * Time   : 2016年01月11日 
     **/
	protected function _search() {
		$map = array ();
		$post_data=I('post.');
		//var_dump($_POST);exit();
		if($post_data['user_name']!=''){
			$map['user_name']=array('like', '%'.$post_data['user_name'].'%');
		}
	
		if($post_data['user_code']!=''){
			$map['user_code']=$post_data['user_code'];
		}
		return $map;
	}
    
    /* 添加
     * Auth   : Ghj
     * Time   : 2016年01月11日 
     **/
	public function add(){
		if(IS_POST){
			$post_data=I('post.');
 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->add($data);
				if($result){
					action_log('Add_DepCenter', 'DepCenter', $result);
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
        	$this->display();
		}
	}
	
    /* 编辑
     * Auth   : Ghj
     * Time   : 2016年01月11日 
     **/
	public function edit(){
		if(IS_POST){
			$post_data=I('post.');
 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->where(array('id'=>$post_data['id']))->save($data);
				if($result){
					action_log('Edit_DepCenter', 'DepCenter', $post_data['id']);
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
			$_info = $this->Model->where(array('id'=>$_info['id']))->find();
			$this->assign('_info', $_info);
        	$this->display();
		}
	}
	
    /* 删除
     * Auth   : Ghj
     * Time   : 2016年01月11日 
     **/
	public function del(){
		$id=I('get.id');
		empty($id)&&$this->error('参数不能为空！');
		$res=$this->Model->delete($id);
		if(!$res){
			$this->error($this->Model->getError());
		}else{
			action_log('Del_DepCenter', 'DepCenter', $id);
			$this->success('删除成功！');
		}
	}
	
}