<?php
namespace App\Controller;

use App\Controller\AppController;

class ArquivosController extends AppController {

    public function index()
    {
        if (!empty($this->request->data)) {
            $this->Upload->send($this->request->data['uploadfile']);
        }
    }
}
