<?php

function check($idcard){
	#身份证是否为空
	if(empty($idcard)){
		return "输入不能为空";
	}
	#身份证只能为18位
	if(strlen($idcard)< 18 ){
		return "身份证不能小于18位字符!";
	}
	if(strlen($idcard)!=18){
		return "您输入的身份证有误,请重新输入!";
	}

/*正则  (dying.......)
	if(preg_match("/[^\s]+/",$idcard)){
	die("no.");
	}*/
	#取出17位
	$idcard_main = substr($idcard,0,17);
	#取出校验码
	$verify_key = substr($idcard,17,1);
	#1-17系数矩阵
	$factor_matrix = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
	#校验码对应的值
	$verify_key_num = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
	#根据前17位计算效验码
	$total = 0;
	for($a = 0; $a < 17; $a++){
		$total = $total+substr($idcard_main,$a,1)*$factor_matrix[$a];
	}
	#取模
	$mod = $total % 11;
	#对比效验码
	if($verify_key == $verify_key_num[$mod]){
		return("flag{sfZ_1s_her0}!");
		
	}else{
		return("flag{pleAse_prIntF_Ture_Sfz}!");
	}
}
$idcard = $_POST['sfz'];
$idname = $_POST['name'];
echo $idname,'<br/>';
echo(check($idcard));
