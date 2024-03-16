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

        return view('home', $data);
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
            ],
            'area' => [
                'label' => 'Área',
                'rules' => 'required',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório'
                ]
            ],
            'complaint' => [
                'label' => 'Reclamação',
                'rules' => 'required|max_length[3000]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres'
                ]
            ],
            'file1' => [
                'label' => 'Ficheiro 1',
                'rules' => 'max_size[file1,512]|ext_in[file1,jpg,pdf]',
                'errors' => [
                    'max_size' => 'O campo {field} deve ter no máximo 512KB',
                    'ext_in' => 'O campo {field} deve ser um ficheiro com extensão do tipo jpg ou pdf'
                ]
            ],

        ]);
        
        if (!$validation) {
            dd($this->validator->getErrors());

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
