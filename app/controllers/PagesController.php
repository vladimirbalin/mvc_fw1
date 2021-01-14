<?php

namespace app\controllers;

use app\libraries\Controller;

class PagesController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $params = ['title' => 'Welcome bros!'];
        $this->render('pages/index', $params);
    }

    public function about($params = [])
    {
        $params = ['title' => 'About us'];

        $this->render('pages/about', $params);
    }
}