<?php


class Pages
{
    public function __construct()
    {
        echo 'pages class instanced';
    }

    public function index()
    {
        
    }
    public function about($params = [])
    {
        foreach ($params as $param) {
            var_dump($param);
        }
    }
}