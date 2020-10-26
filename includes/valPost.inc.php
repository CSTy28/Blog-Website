<?php 

function validatePost($post){
    
    $errors = array();
    
    if(empty($post['title'])) {
        array_push($errors, 'Missing title');
    }
    
    if(empty($post['body'])) {
        array_push($errors, 'Missing body');
    }
    
    if(empty($post['topic_id'])) {
        array_push($errors, 'Missing topic id');
    }
    
    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if($existingPost){
        if(isset($post['update-post']) && $existingPost['id'] != $post['id']){
            array_push($errors, 'Possible Duplicate Post');
        }
        
        if (isset($post['add-post'])) {
            array_push($errors, 'Possible Duplicate Post');
        }
        
    }
    
    return $errors;
    
}






?>