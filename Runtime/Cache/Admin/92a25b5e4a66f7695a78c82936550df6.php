<?php if (!defined('THINK_PATH')) exit();?>

/*
 * <?php echo ($ModelInfo['title']); ?>控制器
 * Auth   : Ghj
 * Time   : <?php echo date("Y年m月d日",time());?> 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Controller;

class <?php echo ($ModelInfo['name']); ?>Controller extends AdminCoreController {
	
    public $Model = null;

    protected function _initialize() {
        parent::_initialize();
        $this->Model = D('<?php echo ($ModelInfo['name']); ?>');
    }
	
    /* 列表(默认首页)
     * Auth   : Ghj
     * Time   : <?php echo date("Y年m月d日",time());?> 
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
				$_list = $this->Model->where($map)->order($post_data['sort'].' '.$post_data['order'])->limit($post_data['first'].','.$post_data['rows'])->select();
			}
            <?php  foreach($_List as $field_key=>$field){ $extra=unserialize($field['extra']); if(in_array($field['type'],array('select','checkbox'))){ if($extra['type']==1){ $option=''; $option=model_field_attr($extra['option']); echo '$option["'.$field["name"].'"]='.var_export($option,true).';
                    '; } if($extra['type']==2){ echo '$op_'.$field['name'].'=R("Admin/Function/get_field_option",array("'.$field["id"].'"));
                     foreach($op_'.$field['name'].' as $op_'.$field['name'].'_key=>$op_'.$field['name'].'_one){
                     	$option["'.$field["name"].'"][$op_'.$field['name'].'_one["key"]]=$op_'.$field["name"].'_one["val"];
                     }
                     '; } if($extra['type']==3){ $extra_option_arr = explode('|',$extra['option']); if($extra_option_arr[1]==''){ $extra_option_arr[1]='type'; $extra_option_arr[2]='value'; } echo '$op_'.$field['name'].'=R("Admin/Function/get_config",array("'.$extra['option'].'"));
                     foreach($op_'.$field['name'].' as $op_'.$field['name'].'_key=>$op_'.$field['name'].'_one){
                     	$option["'.$field["name"].'"][$op_'.$field['name'].'_one["'.$extra_option_arr[1].'"]]=$op_'.$field["name"].'_one["'.$extra_option_arr[2].'"];
                     }
                     '; } if($extra['type']==4){ $extra_option_arr = explode('|',$extra['option']); echo '$op_'.$field['name'].'=R("'.$extra_option_arr[0].'");
                     foreach($op_'.$field['name'].' as $op_'.$field['name'].'_key=>$op_'.$field['name'].'_one){
                     	$option["'.$field["name"].'"][$op_'.$field['name'].'_one["'.$extra_option_arr[1].'"]]=$op_'.$field["name"].'_one["'.$extra_option_arr[2].'"];
                     }
                     '; } } } ?> 
          	foreach($_list as $list_key=>$list_one){
                foreach($list_one as $list_one_key=>$list_one_field){
                    if($option[$list_one_key]!=''){
                        $_list[$list_key][$list_one_key]=$option[$list_one_key][$list_one_field];
                    }
                }
<?php  foreach($_List as $field_key=>$field){ if(in_array($field['type'],array('datetime'))){ $option=''; $extra=unserialize($field['extra']); if($extra['from_type']=='datetimebox'){ echo '                $_list [$list_key]["'.$field["name"].'"]=date("Y年m月d日 H时i分",$_list[$list_key]["'.$field["name"].'"]);'; }else{ echo '                $_list [$list_key]["'.$field["name"].'"]=date("Y年m月d日",$_list[$list_key]["'.$field["name"].'"]);'; } } } ?> 
				$operate_menu='';
				if(Is_Auth('Admin/<?php echo ($ModelInfo['name']); ?>/edit')){
					$operate_menu = $operate_menu."<a href='#' onclick=\"Submit_Form('<?php echo ($ModelInfo['name']); ?>_Form','<?php echo ($ModelInfo['name']); ?>_Data_List','" . U ( 'edit', array ('id' => $_list [$list_key] ['id'] ) ) . "','','编辑数据','');\">编辑</a>";
				}
				if(Is_Auth('Admin/<?php echo ($ModelInfo['name']); ?>/del')){
					$operate_menu = $operate_menu."<a href='#' onclick=\"Data_Remove('" . U ( 'del', array ('id' => $_list [$list_key] ['id'] ) ) . "','<?php echo ($ModelInfo['name']); ?>_Data_List');\">删除</a>";
				}
				$_list [$list_key] ['operate'] = $operate_menu;
            }
			$data = array('total'=>$total, 'rows'=>$_list);
			$this->ajaxReturn($data);
		}else{
        	$this->display();
		}
	}
	
    /* 搜索
     * Auth   : Ghj
     * Time   : <?php echo date("Y年m月d日",time());?> 
     **/
	protected function _search() {
		$map = array ();
		$post_data=I('post.');
		<?php  foreach ($_Search as $key => $field_one ) { if($field_one['type']=='datetime'){?>/* 名称：<?php echo $field_one['title'];?> 字段：<?php echo $field_one['name'];?> 类型：<?php echo $field_one['type'];?>*/
		if($post_data['s_<?php echo $field_one['name'];?>_min']!=''){
			$map['<?php echo $field_one['name'];?>'][]=array('gt',strtotime($post_data['s_<?php echo $field_one['name'];?>_min']));
		}
		if($post_data['s_<?php echo $field_one['name'];?>_max']!=''){
			$map['<?php echo $field_one['name'];?>'][]=array('lt',strtotime($post_data['s_<?php echo $field_one['name'];?>_max']));
		}
		<?php }elseif($field_one['type']=='string' || $field_one['type']=='textarea'){?>/* 名称：<?php echo $field_one['title'];?> 字段：<?php echo $field_one['name'];?> 类型：<?php echo $field_one['type'];?>*/
		if($post_data['s_<?php echo $field_one['name'];?>']!=''){
			$map['<?php echo $field_one['name'];?>']=array('like', '%'.$post_data['s_<?php echo $field_one['name'];?>'].'%');
		}
		<?php }else{?>/* 名称：<?php echo $field_one['title'];?> 字段：<?php echo $field_one['name'];?> 类型：<?php echo $field_one['type'];?>*/
		if($post_data['s_<?php echo $field_one['name'];?>']!=''){
			$map['<?php echo $field_one['name'];?>']=$post_data['s_<?php echo $field_one['name'];?>'];
		}
		<?php } } ?>return $map;
	}
    
    /* 添加
     * Auth   : Ghj
     * Time   : <?php echo date("Y年m月d日",time());?> 
     **/
	public function add(){
		if(IS_POST){
			$post_data=I('post.');
<?php  foreach($_Add as $field_key=>$field){ if(in_array($field['type'],array('datetime'))){ echo '$post_data["'.$field["name"].'"]=strtotime($post_data["'.$field["name"].'"]);'; } if(in_array($field['type'],array('select','checkbox'))){ $extra=unserialize($field['extra']); if($extra['multiple']==1){ echo '$post_data["'.$field["name"].'"]=I("post.'.$field["name"].'");'; echo '$post_data["'.$field["name"].'"]=implode(",",$post_data["'.$field["name"].'"]);'; } } } ?> 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->add($data);
				if($result){
					action_log('Add_<?php echo ($ModelInfo['name']); ?>', '<?php echo ($ModelInfo['name']); ?>', $result);
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
     * Time   : <?php echo date("Y年m月d日",time());?> 
     **/
	public function edit(){
		if(IS_POST){
			$post_data=I('post.');
<?php  foreach($_Edit as $field_key=>$field){ if(in_array($field['type'],array('datetime'))){ echo '$post_data["'.$field["name"].'"]=strtotime($post_data["'.$field["name"].'"]);'; } if(in_array($field['type'],array('select','checkbox'))){ $extra=unserialize($field['extra']); if($extra['multiple']==1){ echo '$post_data["'.$field["name"].'"]=I("post.'.$field["name"].'");'; echo '$post_data["'.$field["name"].'"]=implode(",",$post_data["'.$field["name"].'"]);'; } } } ?> 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->where(array('id'=>$post_data['id']))->save($data);
				if($result){
					action_log('Edit_<?php echo ($ModelInfo['name']); ?>', '<?php echo ($ModelInfo['name']); ?>', $post_data['id']);
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
     * Time   : <?php echo date("Y年m月d日",time());?> 
     **/
	public function del(){
		$id=I('get.id');
		empty($id)&&$this->error('参数不能为空！');
		$res=$this->Model->delete($id);
		if(!$res){
			$this->error($this->Model->getError());
		}else{
			action_log('Del_<?php echo ($ModelInfo['name']); ?>', '<?php echo ($ModelInfo['name']); ?>', $id);
			$this->success('删除成功！');
		}
	}
}