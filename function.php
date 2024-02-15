<?php

    const BASE_URL ="http://localhost:3000/";

    function assts($file){
        return BASE_URL.'assets/'.$file;
    }
    function dd($data) {
        die('<pre>'.var_export($data,true).'</pre>');
    }
    function redirect($path){
        header("location:$path");
        exit();
    }
    function get_excerpt($content,$count=80){
        return substr($content,0,$count). " .....";
    }
    function get_post_by_view($posts){
        uasort($posts, function($first,$second){
                        if($first['view'] > $second['view']){
                              return -1;
                        }else{
                              return 1;
                        }
            });   
            $posts=array_values($posts);
            return count($posts)? $posts:null;         
    }
    function get_data($str) {
        $file_address="./json/".$str.".json";
        $data_file= fopen($file_address,"r+");
        $data_d=fread($data_file,filesize($file_address));
        fclose($data_file);
        return json_decode($data_d,true);
    }
    function get_id ($posts,$id){
        $post=array_filter($posts,function($post) use($id){
            if ($post['id'] == $id ){
                return true;
            } else {
                return false;
            }

        });
         $post=array_values($post);
         return (count($post))? $post[0] : null;
    } 
    function get_word($posts,$search) {
            $search = trim($search);
        $posts = array_filter($posts, function($post) use($search){
            if(strpos($post['title'], $search) !== false or strpos($post['content'], $search) !== false) {
                return true;
            } else {
                return false;
            }
        });

        $posts = array_values($posts);
        return count($posts)? $posts : null;
    }
    function get_category($posts,$category){
        $posts=array_filter($posts,function($post) use($category){
            if ($post['category']== $category){
                return true;
            } else
                return false;           
            
        });
        $posts=array_values($posts);
        return count($posts)? $posts : null;
    }
?>