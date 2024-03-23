<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\ComplaintModel;
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

        // attachment files
        $file1 = $this->request->getFile('file1');
        $file2 = $this->request->getFile('file2');
        $file3 = $this->request->getFile('file3');

        $filenames = [];

        // file 1
        if($file1->isValid() && !$file1->hasMoved()) {
            $newName = $file1->getRandomName();

            $filenames[] = [
                'original' => $file1->getClientName(),
                'new' => $newName
            ];

            $file1->move(WRITEPATH . 'uploads', $newName);
        }

        // file 2
        if($file2->isValid() && !$file2->hasMoved()) {
            $newName = $file2->getRandomName();

            $filenames[] = [
                'original' => $file2->getClientName(),
                'new' => $newName
            ];

            $file2->move(WRITEPATH . 'uploads', $newName);
        }

        // file 3
        if($file3->isValid() && !$file3->hasMoved()) {
            $newName = $file3->getRandomName();

            $filenames[] = [
                'original' => $file3->getClientName(),
                'new' => $newName
            ];

            $file3->move(WRITEPATH . 'uploads', $newName);
        }

        // get total info to store in database
        $data = [
            'email' => $this->request->getPost('email'),
            'name' => $this->request->getPost('name'),
            'area' => $this->request->getPost('area'),
            'complaint' => $this->request->getPost('complaint'),
            'files' => json_encode($filenames)
        ];

        // store in database
        $client_model = new ClientModel();
        $complaint_model = new ComplaintModel();

        // check if the client already exists
        $client = $client_model->where('email', $data['email'])->first();

        if(!$client) {
            $client_model->insert([
                'email' => $data['email'],
                'name' => $data['name'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $client_id = $client_model->getInsertID();
        } else {
            $client_id = $client->id;
        }

        $complaint_model->insert([
            'client_id' => $client_id,
            'area' => $data['area'],
            'message' => $data['complaint'],
            'attachments' => $data['files'],
            'status' => 'pending'
        ]);
    }
}
