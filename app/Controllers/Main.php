<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function submit()
    {

        echo '<pre>';
        print_r($this->request->getPost());
        print_r($this->request->getFiles());

        // dd(
        //     [
        //         $this->request->getPost(),
        //         $this->request->getFiles()
        //     ]
        // );
    }
}
