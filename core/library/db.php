<?php
    function connectToDb(){
        $config = require 'core/configs/db.php';

        $link = @mysqLi_connect($config['host'], $config['user'], $config['password'], $config['db_name']);
        //var_dump($link);
        $links = mysqli_set_charset($link, 'utf8');
        //var_dump($links);

        if(!$link){
            echo "db connect error"; // сделать страницу с ошибкой.
            die();
        }
        mysqli_set_charset($link, 'utf8');
        return $link;
    }

    function  selectData($sql){
        $link = connectToDb();
        $res =  mysqli_query($link, $sql);
        return $res;
    }

    function insertUpdateDelate($sql){
        $link = connectToDb();
        $res =  mysqli_query($link, $sql);

        return $res;
    }

    function getSaveData($str){
        $link =connectToDb();
        return mysqli_real_escape_string($link, $str);
    }

    function findModelById($table, $id){
        $sql = "SELECT * FROM $table WHERE id= $id";
        return selectData($sql);
    }

    function findAllFromTable($table){
        //var_dump($table);
        $sql = "SELECT * FROM $table";
        //$a = selectData($sql);

        return selectData($sql);
    }
    function new_mysqli_fetch_all($result){
        $array=[];
        if(!empty($result)){
            while ($row = mysqli_fetch_assoc($result)) {
                $array[]=$row;
            }
        }
        return $array;
    }

