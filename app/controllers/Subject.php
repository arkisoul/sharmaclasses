<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('subject_model');
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
        $this->subjectConfig = array(
            array(
                'field'  => 'name',
                'label'  => 'Subject',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field} name',
                ),
            ),
            array(
                'field'  => 'name_hindi',
                'label'  => 'Subject',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field} name in Hindi',
                ),
            ),
        );
    }

    public function index()
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->data['subjects'] = $this->subject_model->getAll();
            $this->data['title']    = 'Subjects';
            $this->load->view('header', $this->data);
            $this->load->view('subject/index');
            $this->load->view('footer');
        }
    }

    public function add()
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->subjectConfig);

            if (!$this->form_validation->run()) {
                $this->data['title'] = 'Add Subject';
                $this->load->view('header', $this->data);
                $this->load->view('subject/add');
                $this->load->view('footer');

                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'name'       => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
                            'name_hindi' => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                        ),
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            } else {
                $date = date("Y-m-d H:i:s");
                $data = array_slice($_POST, 0, count($_POST), true);
                if (!array_key_exists('is_active', $data)) {
                    $data['is_active'] = 0;
                }
                if (!array_key_exists('for_test', $data)) {
                    $data['for_test'] = 0;
                }
                if (!array_key_exists('for_study', $data)) {
                    $data['for_study'] = 0;
                }

                $data['created_at'] = $date;

                if ($this->subject_model->add($data)) {
                    addFirebase($this->admin_model->fcmIds(), $this->subject_model->getById($this->subject_model->getInsertId()), 1, 'A new subject added');
                    $json = array(
                        'code' => '200',
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                } else {
                    $json = array(
                        'code' => '402',
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            }
        }
    }

    public function delete($id)
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $subject = $this->subject_model->getById($id);
            if ($this->subject_model->delete($id)) {
                deleteFirebase($this->admin_model->fcmIds(), $subject, 1, 'A subject deleted.');
                $json = array(
                    'code' => '202',
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($json));
            } else {
                $json = array(
                    'code' => '402',
                );
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($json));
            }

        }
    }

    public function edit($id)
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $subject             = $this->subject_model->getById($id);
            $this->data          = array('subject' => $subject[0]);
            $this->data['title'] = 'Edit Subject';
            $this->load->view('header', $this->data);
            $this->load->view('subject/edit');
            $this->load->view('footer');
        }
    }

    public function update($id)
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->subjectConfig);

            if (!$this->form_validation->run()) {
                $subject             = $this->subject_model->getById($id);
                $this->data          = array('subject' => $subject[0]);
                $this->data['title'] = 'Edit Subject';
                $this->load->view('header', $this->data);
                $this->load->view('subject/edit');
                $this->load->view('footer');
                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'name'       => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
                            'name_hindi' => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                        ),
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            } else {
                $date = date("Y-m-d H:i:s");
                $data = array_slice($_POST, 0, count($_POST), true);
                if (!array_key_exists('is_active', $data)) {
                    $data['is_active'] = 0;
                }
                if (!array_key_exists('for_test', $data)) {
                    $data['for_test'] = 0;
                }
                if (!array_key_exists('for_study', $data)) {
                    $data['for_study'] = 0;
                }

                $data['updated_at'] = $date;

                if ($this->subject_model->update($id, $data)) {
                    editFirebase($this->admin_model->fcmIds(), $this->subject_model->getById($id), 1, 'A subject updated.');
                    $json = array(
                        'code' => '200',
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                } else {
                    $json = array(
                        'code' => '402',
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            }

        }
    }

    public function getSubjects()
    {
        $subjects = $this->subject_model->getAll();
        if ($subjects) {
            $json = array(
                'Code'     => '200',
                'Message'  => 'Subject list',
                'Subjects' => $subjects,
            );
            $this->output->set_status_header('200');
            $this->output->set_header('Access-Control-Allow-Origin: *');
        } else {
            $json = array(
                'Code'     => '400',
                'Message'  => 'No subject found',
                'Subjects' => $subjects,
            );
            $this->output->set_status_header('400');
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
}
