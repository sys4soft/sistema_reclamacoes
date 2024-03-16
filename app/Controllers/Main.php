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
            'file2' => [
                'label' => 'Ficheiro 2',
                'rules' => 'max_size[file2,512]|ext_in[file2,jpg,pdf]',
                'errors' => [
                    'max_size' => 'O campo {field} deve ter no máximo 512KB',
                    'ext_in' => 'O campo {field} deve ser um ficheiro com extensão do tipo jpg ou pdf'
                ]
            ],
            'file3' => [
                'label' => 'Ficheiro 3',
                'rules' => 'max_size[file3,512]|ext_in[file3,jpg,pdf]',
                'errors' => [
                    'max_size' => 'O campo {field} deve ter no máximo 512KB',
                    'ext_in' => 'O campo {field} deve ser um ficheiro com extensão do tipo jpg ou pdf'
                ]
            ],

        ]);
        
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }      
        
        // print_r($this->request->getPost());
        // print_r($this->request->getFiles());

        $file1 = $this->request->getFile('file1');
        // $file2 = $this->request->getFile('file2');
        // $file3 = $this->request->getFile('file3');

        // dd([$file1, $file2, $file3]);

        if($file1->isValid() && !$file1->hasMoved()) {
            $newName = $file1->getRandomName();
            $file1->move(WRITEPATH . 'uploads', $newName);
        }

        echo 'OK';

    }
}
