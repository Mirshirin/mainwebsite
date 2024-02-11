<?php

    const BASE_URL ="http://localhost:8000/";
    function assts($file){
        return BASE_URL.'assets/'.$file;
    }
    function dd($data) {
        die('<pre>'.var_export($data,true).'</pre>');
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
?>