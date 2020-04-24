<?php
/***
                                    ***请使用公共的方法模块***
                                    ***请使用公共的方法模块***
                                    ***请使用公共的方法模块***
                                    ***请使用公共的方法模块***
                                    ***请使用公共的方法模块***
                                    ***请使用公共的方法模块***
***/
/**
*一个调用无线分类的方法
*无限极分类
*@param $level 分类级别
*@param $pid 父级id
*@param $data 所有分类
*/
function shangchun($data,$parent_id=0,$level=1){
    if(!$data){
        return;
    };
    static $name = [];
    foreach($data as $v){
        if($v->parent_id == $parent_id){
            $v->level = $level;
            $name[] = $v;
            $name = shangchun($data,$v->cate_id,$level+1);
        }
    }
      return $name;
}
/**
*Display Provides an Alternative Method for uploads. 
*上传方法
*@param int  $id
*@return \Illuminate\Http\Response
*/
function uploads($images){
    if(request()->file($images)->isValid()){
        $file = request()->$images;
        $fant = $file->store("uploads");
        return $fant;
    }
    return exit("文件出错了！");
}
/**
*Display Provides an Alternative Method for uploads. 
*多文件上传方法
*@param int  $id
*@return \Illuminate\Http\Response
*/
function MODEmove($images){
    $file = request()->$images;
    if(!is_array($file)){
        return;
    }
    foreach($file as $k=>$a){
        $fant[$k] = $a->store("uploads");
    }
    return $fant;
        
}

/**
**分装好的回调函数
**error_no 是没错误
**error_msg 提示信息
**data 空数据
**/
function returnJson($error_no=0,$error_msg="",$data=[]){
    $arr = [
        'error_no'=>$error_no,
        'error_msg'=>$error_msg,
        'data'=>$data
    ];
    return json_encode($arr);
}






?>