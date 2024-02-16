<?php
    session_start();
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
    function get_last_post($posts){
        uasort($posts, function($first,$second){
            if($first['id'] > $second['id']){
                  return -1;
            }else{
                  return 1;
                }
            });   
            $posts=array_values($posts);
            return  $posts[0];  
    }
    function get_data($str) {
        $file_address='./json/'.$str.".json";
        $data_file= fopen($file_address,"r+");
        $data_d=fread($data_file,filesize($file_address));
        fclose($data_file);
        return json_decode($data_d,true);
    }
    function set_data($str,$new_data) {
        $new_data = json_encode($new_data);
        $file_address="./json/".$str.".json";
        $data_file= fopen($file_address,"w+");
        $data_d=fwrite($data_file,$new_data);
        fclose($data_file);
        return true;
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
    function delete_post($posts,$id) {
        $posts=array_filter($posts,function($post) use($id){
            if ($post['id'] != $id ){
                return true;
            } else {
                delete_image($post['image']);
                return false;
            }
        });
         $posts=array_values($posts);
         set_data('post',$posts);
         return true;
    }
    function create_post($posts,$title, $category, $content ,$image) {
        $last_post = get_last_post($posts);
        $id = $last_post['id'] + 1;
        $image_name = upload_image($image);
       
        $new_post = [
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'category' => $category,
            'view' => 0,
            'image' => $image_name,
            'date' => date('Y-m-d H:i:s')
        ];

    $posts[] = $new_post;
    set_data('post', $posts);

    return true;
    }
    function login($users,$email,$password){
       $user=array_filter($users,function($user)use($email,$password){
            if ($user['email']== $email and $user['password']==$password){
                return true;
             } else {
                    return false;
                }            
       });
       $user=array_values($user);
       return count($user)? $user[0] : null;
    }
    function validate_login($email, $password){
        $errors=[];       
        if (empty($email)){
            $errors[]='please enter email address.';
        } elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors[]='please fill a valid email.';
        }
        if (empty($password)){
            $errors[]='please enter password address.';
        }
        return $errors;
    }
    function validate_post($title, $category, $content ,$image){
        $errors=[];       
        if (empty($title)){
            $errors[]='please enter title address.';
        } else if(strlen($title)<3){
            $errors[]='please fill a valid title more than 3 character.';
        }
        if (empty($category)){
            $errors[]='please enter a category .';
        }   else if (! in_array($category,['political','book','sport'])){
            $errors[]= 'please enter a category in this list "political","book","sport" ';
        }

        if (empty($content)){
            $errors[]='please enter a content .';
        }if(strlen($content)<3){
            $errors[]='please fill a valid $content more than 3 character.';
        }
        if (! is_array($image)){
            $errors[]='selected image is invalid .';

        }else if (!$image['name']){
            $errors[]='please fill image field .';

        }else if ($image['size'] > 500000){
            $errors[]='Image size should be less than 5k byte .';

        }else if (! in_array($image['type'],['image/png','image/jpeg','image/gif'])){
            $errors[]='Image type should be ["image/png","image/jpeg","image/gif"].';

        }

        return $errors;
    }
    
    function authenticated(){
        if (isset($_SESSION['user'])){
            return true;        
        }else{
            return false;
        }
    }
    function logout() {
        unset($_SESSION['user']);
        redirect('login.php');
    }
    function get_user_data() {
        if (authenticated()){
            return $_SESSION['user'];
        }else{
            return null;
        }
    }
    function upload_image($file) {
        $dir = 'assets/images/';
        $name = $file['name'];
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $new_name = time() . '.' . $extension;
        $tmp = $file['tmp_name'];
    
        if(move_uploaded_file($tmp, $dir . $new_name)) {
            return "images/$new_name";
        } else {
            return '';
        }
    }
    function delete_image($image) {
        if (file_exists('assets/' . $image)) {
            unlink('assets/' . $image);
            return true;
        } else {
            return false;
        }
    }
    function edit_post($posts, $id, $title, $category, $content, $image) {
        $posts = array_map(function($post) use($id, $title, $content, $category, $image) {
            if($post['id'] == $id) {
                $post['title'] = $title;
                $post['content'] = $content;
                $post['category'] = $category;
    
                if(! empty($image['name'])) {
                    delete_image($post['image']);
                    $post['image'] = upload_image($image);
                }
            }
    
            return $post;
        }, $posts);
    
        set_data('post', $posts);
        return true;
    } 
    function validate_edit_post($title, $category, $content, $image) {
        $errors = [];
    
        if(empty($title)) {
            $errors[] = 'Please fill title field.';
        } else if(strlen($title) < 3) {
            $errors[] = 'Please enter title bigger than 3 chars.';
        }
    
        if(empty($category)) {
            $errors[] = 'Please select one category.';
        } else if(! in_array($category, ['political', 'sport', 'book'])) {
            $errors[] = 'Selected category is invalid.';
        }
    
        if(empty($content)) {
            $errors[] = 'Please fill content field.';
        } else if(strlen($content) < 5) {
            $errors[] = 'Please enter content bigger than 5 chars.';
        }
    
        if(!empty($image['name'])) {
            if(! is_array($image)) {
                $errors[] = 'Selected image is invalid.';
            } else if ($image['size'] > 500000) {
                $errors[] = 'Image size should be smaller than 5MB.';
            } else if (! in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
                $errors[] = 'Selected image is invalid.';
            }
        }
    
    
        return $errors;
    }
    