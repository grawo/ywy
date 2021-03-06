<?php if (!defined('THINK_PATH')) exit();?>

/*
 * <?php echo ($ModelInfo['title']); ?>模型
 * Auth   : Ghj
 * Time   : <?php echo time("Y年m月d日");?> 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class <?php echo ($ModelInfo['name']); ?>Model extends Model{

    /* 自动验证规则 */
	protected $_validate = array(<?php foreach ($ModelField as $key => $field_one ) { if($field_one['validate_rule']!=''){ echo '		'.$field_one['validate_rule'].'
';}}?> 
	);

    /* 自动完成规则 */
	protected $_auto = array(<?php foreach ($ModelField as $key => $field_one ) { if($field_one['auto_rule']!=''){echo '		'.$field_one['auto_rule'].'
';}}?> 
	);

}