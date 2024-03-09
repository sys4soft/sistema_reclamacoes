<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    public function index()
    {
        // check for validation errors       
        $data['validation_errors'] = session()->getFlashdata('errors');

        return view('home');
    }

    public function submit()
    {
        
        // form validation
        $validation = $this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'valid_email' => 'O campo {field} deve ser um email válido'
                ]
            ]
        ]);
        
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        
        die('OK');
        
        
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
