<?php


namespace app\controllers;


use app\helpers\SessionHelper;
use app\helpers\UrlHelper;
use app\libraries\Controller;
use app\libraries\Core;
use app\models\PostsModel;
use app\models\UserModel;

class PostsController extends Controller
{
    private PostsModel $postsModel;
    private UserModel $userModel;

    public function __construct()
    {
        if (!SessionHelper::isLoggedIn()) UrlHelper::simple_redirect('users/login');
        $this->postsModel = new PostsModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $params = $this->postsModel->getPosts();
        $this->render('posts/index', $params);
    }

    public function add()
    {
        define('REQUIRED_FIELD_ERROR', 'This field is required');

        if (Core::$request->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $params = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'errors' => [
                    'title' => '',
                    'body' => ''
                ]
            ];

            if (!$params['title']) {
                $params['errors']['title'] = REQUIRED_FIELD_ERROR;
            }
            if (!$params['body']) {
                $params['errors']['body'] = REQUIRED_FIELD_ERROR;
            }

            if (empty($params['errors']['title']) &&
                empty($params['errors']['body'])) {


                if ($this->postsModel->addPost($_SESSION['user_id'], $params['title'], $params['body'])) {
                    SessionHelper::flash('post_info', 'Post Added');
                    UrlHelper::simple_redirect('posts');
                } else {
                    $params['errors']['title'] = 'database problems';
                    $params['errors']['body'] = 'database problems';

                    $this->render('posts/add', $params);
                }
            } else {
                $this->render('posts/add', $params);
            }
        } else {
            $params = [
                'title' => '',
                'body' => ''
            ];
            $this->render('posts/add', $params);
        }

    }

    public function show($params = [])
    {
        $post = $this->postsModel->getPost($params);
        $user = $this->userModel->getUser($post->user_id);
        $params = [
            'post' => $post,
            'user' => $user
        ];
        $this->render('posts/show', $params);
    }

    public function edit($post_id)
    {
        define('REQUIRED_FIELD_ERROR', 'This field is required');

        if (Core::$request->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $params = [
                'post_id' => $post_id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'errors' => [
                    'title' => '',
                    'body' => ''
                ]
            ];

            if (!$params['title']) {
                $params['errors']['title'] = REQUIRED_FIELD_ERROR;
            }
            if (!$params['body']) {
                $params['errors']['body'] = REQUIRED_FIELD_ERROR;
            }

            if (empty($params['errors']['title']) &&
                empty($params['errors']['body'])) {


                if ($this->postsModel->updatePost($params['post_id'], $params['title'], $params['body'])) {
                    SessionHelper::flash('post_info', 'Post updated');
                    UrlHelper::simple_redirect('posts');
                } else {
                    $params['errors']['title'] = 'database problems';
                    $params['errors']['body'] = 'database problems';

                    $this->render('posts/add', $params);
                }
            } else {
                $this->render('posts', $params);
            }
        } else {
            $post = $this->postsModel->getPost($post_id);
            if ($post->user_id !== $_SESSION['user_id']) {
                UrlHelper::simple_redirect('posts');
            }
            $params = [
                'id' => $post_id,
                'title' => $post->title,
                'body' => $post->body];
            $this->render('posts/edit', $params);
        }

    }

    public function delete($post_id)
    {
        if (Core::$request->isPost()) {
            $post = $this->postsModel->getPost($post_id);
            if ($post->user_id !== $_SESSION['user_id']) {
                UrlHelper::simple_redirect('posts');
            } else {
                if($this->postsModel->deletePost($post_id))
                {
                    SessionHelper::flash('post_info', 'Post deleted');
                    UrlHelper::simple_redirect('posts');
                } else {
                    SessionHelper::flash('post_info', 'Post HAVEN\'T deleted');
                    UrlHelper::simple_redirect('posts');
                }
            }
        } else {
            UrlHelper::simple_redirect('posts');
        }

    }
}