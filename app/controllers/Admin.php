<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
        $this->loginConfig = array(
            array(
                'field'  => 'username',
                'label'  => 'Username',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}',
                ),
            ),
            array(
                'field'  => 'password',
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}',
                ),
            ),
        );
    }

    public function index()
    {
        if (!$this->session->__get('user')) {
            $this->form_validation->set_rules($this->loginConfig);

            if (!$this->form_validation->run()) {
                $this->load->view('login');

                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'username' => form_error('username', '<p class="mt-3 text-danger">', '</p>'),
                            'password' => form_error('password', '<p class="mt-3 text-danger">', '</p>'),
                        ),
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            } else {
                $data = array(
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                );
                if ($this->admin_model->login($data)) {
                    $user = $this->admin_model->read_user($data['username']);
                    if ($user) {
                        $userdata = array(
                            'name'  => $user[0]->name,
                            'email' => $user[0]->email,
                        );
                        $this->session->__set('user', $userdata);
                        $json = array(
                            'code' => '200',
                            'link' => base_url() . 'dashboard',
                        );
                        $this->output
                            ->set_content_type('application/json')
                            ->set_output(json_encode($json));
                    }
                } else {
                    $json = array(
                        'code'  => '402',
                        'error' => 'Incorrect username or password',
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            }

        } else {
            $this->data['title'] = 'Dashboard';
            $this->load->view('header', $this->data);
            $this->load->view('dashboard');
            $this->load->view('footer');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy('user');
        redirect('/');
    }
}
