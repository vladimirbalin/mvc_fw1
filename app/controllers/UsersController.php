<?php

namespace app\controllers;

use app\helpers\SessionHelper;
use app\helpers\UrlHelper;
use app\libraries\Controller;
use app\libraries\Core;
use app\models\UserModel;

class UsersController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        define('REQUIRED_FIELD_ERROR', 'This field is required');

        if (Core::$request->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $params = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password'],
                'errors' => [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                ],
            ];

            if (!$params['name']) {
                $params['errors']['name'] = REQUIRED_FIELD_ERROR;
            } else if (strlen($params['name']) < 6 || strlen($params['name']) > 16) {
                $params['errors']['name'] = 'Username must be less than 16 and more than 6 chars';
            }
            if (!$params['email']) {
                $params['errors']['email'] = REQUIRED_FIELD_ERROR;
            } else if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                $params['errors']['email'] = 'Please enter valid email address';
            } else if ($this->userModel->findUserByEmail($params['email'])) {
                $params['errors']['email'] = 'Email is already taken';
            }
            if (!$params['password']) {
                $params['errors']['password'] = REQUIRED_FIELD_ERROR;
            }
            if (!$params['confirm_password']) {
                $params['errors']['confirm_password'] = REQUIRED_FIELD_ERROR;
            }
            if ($params['password'] && $params['confirm_password'] && strcmp($params['password'], $params['confirm_password']) !== 0) {
                $params['errors']['confirm_password'] = 'Please repeat the password correctly';
            }
            if (empty($params['errors']['name']) &&
                empty($params['errors']['email']) &&
                empty($params['errors']['password']) &&
                empty($params['errors']['confirm_password'])) {

                if ($this->userModel->createNewUser($params['name'], $params['email'], $params['password'])) {
                    SessionHelper::flash('register_success', 'You are registered and can log in');
                    UrlHelper::simple_redirect('users/login');
                } else {
                    foreach ($params['errors'] as $field => $value) {
                        $params['errors'][$field] = 'database problems';
                    }

                    $this->render('posts/add', $params);
                };

            } else {
                $this->render('users/register', $params);
            }
        } else if (Core::$request->isGet()) {
            $params = [
                'name' => '',
                'email' => '',
                'password' => '',
                'password_confirm' => '',
                'errors' => [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                ],
            ];
            $this->render('users/register', $params);
        }
    }

    public function login()
    {
        define('REQUIRED_FIELD_ERROR', 'This field is required');

        if (Core::$request->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $params = [
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'errors' => [
                    'email' => '',
                    'password' => '',
                ],
            ];
            if (!$params['email']) {
                $params['errors']['email'] = REQUIRED_FIELD_ERROR;
            } else if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                $params['errors']['email'] = 'Please enter valid email address';
            } else if (!$this->userModel->findUserByEmail($params['email'])) {
                $params['errors']['email'] = 'No such user in the system';
            }
            if (!$params['password']) {
                $params['errors']['password'] = REQUIRED_FIELD_ERROR;
            }

            if (empty($params['errors']['name']) &&
                empty($params['errors']['email']) &&
                empty($params['errors']['password'])) {
                $loggedInUser = $this->userModel->login($params['email'], $params['password']);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $params['errors']['password'] = 'Password incorrect';
                    $this->render('users/login', $params);
                }
            } else {
                $this->render('users/login', $params);
            }
        } elseif (Core::$request->isGet()) {
            $params = [
                'email' => '',
                'password' => '',
                'errors' => [
                    'email' => '',
                    'password' => '',
                ],
            ];
            $this->render('users/login', $params);
        }

    }

    public function logout()
    {
        unset($_SESSION['user_id'], $_SESSION['user_email'], $_SESSION['user_email']);
        UrlHelper::simple_redirect('pages/index');
    }



    private function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        UrlHelper::simple_redirect('posts/index');
    }
}