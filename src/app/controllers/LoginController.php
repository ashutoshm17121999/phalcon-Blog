<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        $users = new Users();
        if ($this->request->isPost()) {
            $users = Users::findFirst(array(
                'email = :email: and password = :password:', 'bind' => array(
                    'email' => $this->request->getPost("email"),
                    'password' => $this->request->getPost("password")
                )
            ));
            $users = json_decode(json_encode($users));
            // print_r($users);
            // die();
            if ($users->email == $this->request->getPost("email")) {

                $this->response->redirect('dashboard/index');
            } else {
                $this->session->set('message', "Wrong credentials...");
                $this->response->redirect('login');
            }
            //return '<h1>Hello!!!</h1>';
        }
    }
    public function dashboardAction()
    {
    }
}
