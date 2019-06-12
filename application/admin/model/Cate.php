<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{
    
	public function cate(){
		return $this->belongsTo('cate','cateid');
	}




}
