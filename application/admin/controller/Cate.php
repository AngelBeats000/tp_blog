<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use app\admin\controller\Base;
class Cate extends Base
{
    public function lst()
    {
        $list=cateModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
    	if (request()->isPost()) {

    		$data=[
    			'catename'=>input('catename'),
    		];
            
    		$validate = \think\Loader::validate('Cate');
			if(!$validate->scene('add')->check($data)){
			    $this->error($validate->getError());
			    die;
			}

    		if(db('cate')->insert($data)){
    			return $this->success('添加成功!','lst');
    		}else{
    			return $this->error('添加失败!');
    		}
    		return;
    	}
        return $this->fetch('add');
    }

    //删除
    public function del()
    {
        $id=input('id');
        if(db('cate')->delete($id)){
            $this->success('删除成功','lst');
        }else{
            $this->errror('删除失败');
        }
    }

    //修改
    public function edit(){
        $id=input('id');
        $cates=db('cate')->find($id);
        if(request()->isPost()){
            $data=[
                'id'=>input('id'),
                'catename'=>input('catename'),
            ];

            $validate = \think\Loader::validate('Cate');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
                die;
            }
            $save=db('cate')->update($data);
            if($save!==false){
                $this->success('修改成功','lst');
            }else{
                $this->error('修改失败！！！');
            }
            return;
        }        
        $this->assign('cates',$cates);
        return $this->fetch('edit');
    }

}
