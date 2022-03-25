<?php

use Phalcon\Mvc\Controller;


class DashboardController extends Controller
{
    public function indexAction()
    {
        $this->view->users = Users::find();

        // return '<h1>Hello World!</h1>';
    }
    public function statusAction()
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            $user = Users::findFirst(array(
                'id = :id:', 'bind' => array(
                    'id' => $id

                )
            ));
            // $status = $this->request->getPost('status');
            if ($user->status == 'restricted') {
                $user->status = 'approved';
            } else {
                $user->status = 'restricted';
            }
            $user->update();


            $this->response->redirect('dashboard/index');

            // echo 'ashusaushuahsua';
            // die();
        }
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            $user = Users::findFirst(array(
                'id = :id:', 'bind' => array(
                    'id' => $id

                )
            ));
            $user->delete();
            $this->response->redirect('dashboard/index');
        }
    }
}
