<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{

    public function IndexAction()
    {
    }

    public function registerAction()
    {
        $user = new Users();
        $userrr = Users::findFirst(array(
            'email = :email:', 'bind' => array(
                'email' => $this->request->getPost("email"),
            )
        ));
        $userrr=json_decode(json_encode($userrr));
        // echo 'asssss='.$userrr->email.'assss';
        // echo 'daaaa='.$this->request->getPost("email").'daaa';
        // die();

        if ($userrr->email == $this->request->getPost("email") && !empty($this->request->getPost("email"))) {
            $this->session->set('message', "Email already exists......");
            $this->response->redirect('/signup');
        } else {
            $user->assign(
                $this->request->getPost(),
                [
                    'firstname',
                    'lastname',
                    'email',
                    'password'
                ]
            );
            $user->role = "user";
            $user->status = "restricted";
            $success = $user->save();

            $this->view->success = $success;

            // die();
            if ($success) {
                $this->session->set('message', "Register succesfully");
                $this->response->redirect('/signup');
            } else {
                $this->session->set('message', "Not Register succesfully due to following reason: <br>" . implode("<br>", $user->getMessages()));
                $this->response->redirect('/signup');
            }
        }
    }
}
