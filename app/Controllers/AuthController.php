<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper('form');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerUser()
    {
        if (!$this->validate([
            'username' => 'required',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->userModel->save($data);

        return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
    }
    public function login()
    {
        return view('auth/login');
    }

    public function loginUser()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id' => $user['id'],
                'username' => $user['username'],
                'logged_in' => true,
            ]);

            return redirect()->to('/dashboard');
        }
        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
