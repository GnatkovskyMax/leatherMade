<?php
    function action_index(){
        $category_first=new_mysqli_fetch_all(findAllCategory());
        $_SESSION['lang']=(!empty($_SESSION['lang']))? $_SESSION['lang'] : "ru";
        $category_id=(!empty($_SESSION['cat_id']))? +($_SESSION['cat_id']) :$category_first[0]['id'];
            $page= (!empty($_SESSION['page']))? +($_SESSION['page']) : 1;
        $page_post= (!empty($_SESSION['page_post']))? +($_SESSION['page_post']) : 1; //new
        $posts = new_mysqli_fetch_all(findAllPosts($page_post)['from_post']);//первые два поста//new
        $all_post = findAllPosts($page_post)['all_post'];//все посты для кнопок//new
        $category_nav = new_mysqli_fetch_all(findAllCategory());//все категории
        $product= new_mysqli_fetch_all(getAllObjectIn_Cat_From($category_id, $page)['from']);
        $buttons= getAllObjectIn_Cat_From($category_id, $page)['all'];
        renderView('index', ['category'=>$category_nav,
                                       'posts' => $posts,
                                       'all_post'=>$all_post,
                                       'product'=> $product,
                                       'btn'=>$buttons,
                                       'cat_id'=>$category_id]);
    }



