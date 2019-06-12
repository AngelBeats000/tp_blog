<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\Base;
class Admin extends Base
{
    public function lst()
    {
        $list=AdminModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
    	if (request()->isPost()) {

            $data=[
                'username'=>input('username'),
                'password'=>md5(input('password')),
            ];
            //验证添加的信息
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                //error提示错误信息，dump打印错误信息
                $this->error($validate->getError());
                die;
            }

            if(db('admin')->insert($data)){
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
        if($id!=1){
            if(db('admin')->delete($id)){
                $this->success('删除成功','lst');
            }else{
                $this->errror('删除失败');
            }
        }else{
            $this->errror('初始化管理员无法删除');
        }
        
    }

    //修改
    public function edit(){
        $id=input('id');
        $admins=db('admin')->find($id);
        if(request()->isPost()){
            $data=[
                'id'=>input('id'),
                'username'=>input('username'),
            ];
            if (input('password')) {
                $data['password']=md5(input('password'));
            }else{
                $data['password']=$admins['password'];
            }

            $validate = \think\Loader::validate('Admin');
            if(!$validate->check($data)){
                $this->error($validate->getError());
                die;
            }
            $save=db('admin')->update($data);
            if($save !==false){
                $this->success('修改成功','lst');
            }else{
                $this->error('修改失败！！！');
            }
            return;
        }        
        $this->assign('admins',$admins);
        return $this->fetch('edit');
    }

    public function logout(){
        session(null);
        $this->success('退出成功','Login/index');
    }

}
