<?php
namespace app\admin\controller;
use app\admin\model\Article as ArticleModel;
use app\admin\controller\Base;
class Article extends Base
{
    public function lst()
    {
        //关联方法一
        $list=db('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.author,a.pic,a.state,c.catename')->paginate(3);
        //关联方法二，在model里面相对关联
        //$list=ArticleModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
    	if (request()->isPost()) {
    		$data=[
    			'title'=>input('title'),
    			'author'=>input('author'),
                'keywords'=>str_replace('，',',',input('keywords')),
                'desc'=>input('desc'),
                'cateid'=>input('cateid'),
                'content'=>input('content'),
                'time' =>time(),
    		];
            if (input('state')=='on') {
                $data['state']=1;
            }else{$data['state']=0;}



            if ($_FILES['pic']['tmp_name']) {
                $file = request()->file('pic');

                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }
    		$validate = \think\Loader::validate('Article');
			if(!$validate->scene('add')->check($data)){
			    $this->error($validate->getError());
			    die;
			}

    		if(db('article')->insert($data)){
    			return $this->success('文章添加成功!','lst');
    		}else{
    			return $this->error('文章添加失败!');
    		}
    		return;
    	}
        $cateres=db('cate')->select();
        $this->assign('cateres',$cateres);
        return $this->fetch('add');
    }

    //删除
    public function del()
    {
        $id=input('id');
        if(db('Article')->delete($id)){
            $this->success('删除成功','lst');
        }else{
            $this->errror('删除失败');
        }
    }

    //修改
    public function edit(){
        $id=input('id');
        $articles=db('Article')->find($id);
        if(request()->isPost()){
            $data=[
                'id'    =>input('id'),
                'title'=>input('title'),
                'author'=>input('author'),
                'keywords'=>str_replace('，',',',input('keywords')),
                'desc'=>input('desc'),
                'cateid'=>input('cateid'),
                'content'=>input('content'),
            ];
            if (input('state')=='on') {
                $data['state']=1;
            }else{
                $data['state']=0;
            }
            if ($_FILES['pic']['tmp_name']) {
                @unlink(SITE_URL.'/public/static'.$articles['pic']);
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }

            $validate = \think\Loader::validate('Article');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
                die;
            }

            if(db('Article')->update($data)){
                $this->success('修改成功','lst');
            }else{
                $this->error('修改失败！！！');
            }
            return;
        }        
        
        $this->assign('articles',$articles);
        $cateres=db('cate')->select();
        $this->assign('cateres',$cateres);
        return $this->fetch('edit');
    }

}
