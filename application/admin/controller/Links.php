<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Links as LinksModel;
class Links extends Base
{
    public function lst()
    {
        $list=LinksModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
    	if (request()->isPost()) {

    		$data=[
    			'title'=>input('title'),
    			'url'=>input('url'),
                'desc'=>input('desc'),
    		];

    		$validate = \think\Loader::validate('Links');
			if(!$validate->scene('add')->check($data)){
			    $this->error($validate->getError());
			    die;
			}

    		if(db('links')->insert($data)){
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
        if(db('Links')->delete($id)){
            $this->success('删除成功','lst');
        }else{
            $this->errror('删除失败');
        }
    }

    //修改
    public function edit(){
        $id=input('id');
        $Links=db('links')->find($id);
        if(request()->isPost()){
            $data=[
                'id'=>input('id'),
                'title'=>input('title'),
                'url'=>input('url'),
                'desc'=>input('desc'),
            ];
            $validate = \think\Loader::validate('Links');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
                die;
            }

            if(db('links')->update($data)){
                $this->success('修改成功','lst');
            }else{
                $this->error('修改失败！！！');
            }
            return;
        }        
        $this->assign('Links',$Links);
        return $this->fetch('edit');
    }

}
