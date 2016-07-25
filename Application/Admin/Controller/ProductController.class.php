<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/19
 * Time: 10:50
 */
namespace Admin\Controller;

class ProductController extends AdminController{

    //产品列表
    public function index(){
        $search=strval($_GET['search']);
        if(!empty($search)) {
            $condition['title']=array("LIKE","%".$search."%");
            $count = M("Product")->where($condition)->count();
            $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
            $page = new \Think\Page($count, $listrows);
            $products = M("Product")->where($condition)->limit($page->firstRow, $page->listRows)->order('sort ASC,createtime DESC')->select();
        }else{
            $count = M("Product")->count();
            $listrows = C("LISTROWS") ? C("LISTROWS") : 10;
            $page = new \Think\Page($count, $listrows);
            $products = M("Product")->limit($page->firstRow, $page->listRows)->order('sort ASC,createtime DESC')->select();
        }
        //将分类id转换为名称
        if(!empty($products)) {
            foreach ($products as $k => $v) {
                $category=M("Category")->find($v['cate_id']);
                $products[$k]['category_name'] = $category['category_name'];
            }
        }

        $this->assign("products",$products);
        $this->assign("page_html",$page->show());

        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }

    //添加产品
    public function add(){
        if(IS_POST){
            $data=M("Product")->create();
            $data['createtime']=time();
            $res=M("Product")->add($data);
            if($res){
                Adminlog(session("user")['user_name'],"ADD" , "Product",$res ,json_encode($data) );
                $this->success("添加产品成功！",U("Product/index"));
                die;
            }else{
                $this->error("添加产品失败！",U("Product/index"));die;
            }
        }
        $categories=M("Category")->select();
        $this->assign("categories",$categories);
        $this->display();
    }
    //修改产品
    public function edit(){
        $id=intval($_GET['id']);
        //先查询是否存在产品
        $product=M("Product")->find($id);
        if(empty($product)){
            $this->error("不存在该产品！");die;
        }
        if(IS_POST){
            $data=M("Product")->create();
            $data['id']=$id;
            $res=M("Product")->save($data);
            if($res){
                Adminlog(session("user")['user_name'],"MODIFY" , "Product",$id ,json_encode($data) );
                $this->success("修改产品成功！",U("Product/index"));
                die;
            }else{
                $this->error("修改产品失败！",U("Product/edit",array("id"=>$id)));die;
            }
        }

        $this->assign("product",$product);
        //查询出对应的图片预览信息
        if(!empty($product['pics'])) {
            $where['id'] = array(
                "IN", $product['pics']
            );
            $files = M("File")->where($where)->select();
            $this->assign("pics", $files);
        }
        $categories=M("Category")->select();
        $this->assign("categories",$categories);
        $this->display();
    }
    //删除产品
    public function del(){
        $id=intval($_GET['id']);
        if(!empty($id)){
            //先查询是否存在该产品
            $product=M("Product")->find($id);
            if(empty($product)){
                $this->error("不存在该产品！");die;
            }
            $data=array("id"=>$id);
            $res=M("Product")->where($data)->delete();
            if($res){
                Adminlog(session("user")['user_name'],"DEL" , "Product",$id ,json_encode($product) );
                $this->success("删除产品成功！",U("Product/index"));die;
            }else{
                $this->error("删除产品失败！",U("Product/index"));die;
            }
        }else{
            $this->error("未获取到id！");die;
        }
    }

    //分类列表
    public function category(){
        $count=M("Category")->count();
        $listrows=C("LISTROWS")?C("LISTROWS"):10;
        $page=new \Think\Page($count,$listrows);
        $categories=M("Category")->limit($page->firstRow,$page->listRows)->select();
        $this->assign("categories",$categories);
        $this->assign("page_html",$page->show());

        $acjs=renderJsConfirm("icon-remove");
        $this->assign("action_confirm",$acjs);
        $this->display();
    }

    //分类添加
    public function category_add(){
        if(IS_POST){
            $data=M("Category")->create();
            if($data['category_name']==""){
                $this->error("分类名称不能为空！");die;
            }
            $data['createtime']=time();
            $res=M("Category")->add($data);
            if($res){
                Adminlog(session("user")['user_name'],"ADD" , "Category",$res ,json_encode($data) );
                $this->success("添加分类成功！",U("Product/category"));die;
            }else{
                $this->error("添加分类失败！",U("Product/category_add"));die;
            }
        }
        $this->display();
    }
    //分类修改
    public function category_edit(){
        $cate_id=intval($_GET['category_id']);
        if(IS_POST){
            $data=M("Category")->create();
            if($data['category_name']==""){
                $this->error("分类名称不能为空！");die;
            }
            $data['id']=$cate_id;
            $res=M("Category")->save($data);
            if($res){
                Adminlog(session("user")['user_name'],"Modify" , "Category",$data['id'] ,json_encode($data) );
                $this->success("修改分类成功！",U("Product/category"));die;
            }else{
                $this->error("修改分类失败！",U("Product/category_edit",array("category_id"=>$cate_id)));die;
            }
        }
        $category=M("Category")->find($cate_id);
        $this->assign("category",$category);
        $this->display();
    }

    //分类修改
    public function category_del(){
        $cate_id=intval($_GET['category_id']);
        $data=array(
            "id"=>$cate_id
        );
        //先查看是否存在该分类
        $category=M("Category")->where($data)->find();
        if(empty($category)){
            $this->error("不存在该分类！");die;
        }
        $res=M("Category")->where($data)->delete($cate_id);
        if($res){
            Adminlog(session("user")['user_name'],"Modify" , "Category",$data['id'] ,json_encode($category) );
            $this->success("删除分类成功！",U("Product/category"));die;
        }else{
            $this->error("删除分类失败！",U("Product/category"));die;
        }
    }
}