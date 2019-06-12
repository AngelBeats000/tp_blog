<?php
namespace app\admin\validate;
use think\Validate;
class Article extends Validate
{
     protected $rule = [
        'title'  =>  'require|max:30',
        'author'  =>  'require',
        'cateid' =>  'require',
        'content' =>  'min:10',
    ];
     protected $message  =   [
        'title.require' => '文章标题必须',
        'title.max'     => '文章标题最多不能超过30个字符',
        'author.require'   => '文章作者必须存在',
        'cateid.require' => '请选择文章所属栏目',
        'content.min' => '文章内容必须在10个字以上',
    ];
    protected $scene = [
        'add'  =>  ['title','author','cateid','content'],
        'edit'=>['title','author','cateid','content'],
    ];
}
