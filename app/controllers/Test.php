<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('subject_model');
        $this->load->model('test_model');
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
        $this->testConfig = array(
            array(
                'field'  => 'name',
                'label'  => 'Test',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field} name',
                ),
            ),
            array(
                'field'  => 'subject_id',
                'label'  => 'Subject',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must select {field}',
                ),
            ),
            array(
                'field'  => 'time',
                'label'  => 'Time',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide {field} for this test',
                ),
            ),
            array(
                'field'  => 'questions_num',
                'label'  => 'No of Questions',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide {field} for this test',
                ),
            ),
        );
    }

    public function index($id = null)
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            if ($id) {
                $tests = $this->test_model->getTestsBySubjectId($id);
                if ($tests) {
                    $html  = '';
                    $count = 1;
                    foreach ($tests as $test) {
                        $html .= '<tr id="data_' . $test['id'] . '">';
                        $html .= '<td>' . $count . '</td>';
                        $html .= '<td>' . $test['name'] . '</td>';
                        $html .= '<td>' . $test['time'] . '</td>';
                        $html .= '<td>' . $test['questions_num'] . '</td>';
                        $html .= '<td><button class="btn btn-danger" data-id="' . $test['id'] . '" data-base="' . base_url() . '" data-item="test" data-action="remove" data-toggle="modal" data-target="#confirmationModal"> <i class="fa fa-trash"></i></button></a><a class="btn btn-primary" href="' . base_url() . 'test/edit/' . $test['id'] . '" ><i class="fa fa-pencil"></i></a></td>';
                        $count++;
                    }
                    $json = array(
                        'code'    => '200',
                        'objects' => $html,
                    );
                } else {
                    $json = array(
                        'code'    => '400',
                        'objects' => '<tr><td colspan="5" class="text-center">No test added in this subject</td></tr>',
                    );
                }
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($json));
            } else {
                $this->data['tests']    = [];
                $this->data['subjects'] = $this->subject_model->getAll();
                $this->data['title']    = 'Tests';
                $this->load->view('header', $this->data);
                $this->load->view('test/index');
                $this->load->view('footer');
            }
        }
    }

    public function add()
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->testConfig);

            if (!$this->form_validation->run()) {
                $this->data['subjects'] = $this->subject_model->getAll();
                $this->data['title']    = 'Add Test';
                $this->load->view('header', $this->data);
                $this->load->view('test/add');
                $this->load->view('footer');

                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'name'          => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
                            'subject_id'    => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                            'time'          => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                            'questions_num' => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                        ),
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            } else {
                $data = array_slice($_POST, 0, count($_POST), true);
                if (!array_key_exists('is_active', $data)) {
                    $data['is_active'] = 0;
                }

                if ($this->test_model->add($data)) {
                    addFirebase($this->admin_model->fcmIds(), $this->test_model->getById($this->test_model->getInsertId()), 3, 'A new test added');
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
            $test = $this->test_model->getById($id);
            if ($this->test_model->delete($id)) {
                deleteFirebase($this->admin_model->fcmIds(), $test, 3, 'A test deleted');
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
            $test                   = $this->test_model->getById($id);
            $this->data['subjects'] = $this->subject_model->getAll();
            $this->data['test']     = $test[0];
            $this->data['title']    = 'Edit Test';
            $this->load->view('header', $this->data);
            $this->load->view('test/edit');
            $this->load->view('footer');
        }
    }

    public function update($id)
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->testConfig);

            if (!$this->form_validation->run()) {
                $test                   = $this->test_model->getById($id);
                $this->data['subjects'] = $this->subject_model->getAll();
                $this->data['test']     = $test[0];
                $this->data['title']    = 'Edit Test';
                $this->load->view('header', $this->data);
                $this->load->view('test/edit');
                $this->load->view('footer');
                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'name'          => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
                            'subject_id'    => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                            'time'          => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                            'questions_num' => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                        ),
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            } else {
                $data = array_slice($_POST, 0, count($_POST), true);
                if (!array_key_exists('is_active', $data)) {
                    $data['is_active'] = 0;
                }

                if ($this->test_model->update($id, $data)) {
                    editQuestionFirebase($this->admin_model->fcmIds(), $this->test_model->getById($id), 3, 'A test updated');
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

    public function getTests()
    {
        $tests = $this->test_model->getAll();
        if ($tests) {
            $json = array(
                'Code'    => '200',
                'Message' => 'tests list',
                'Tests'   => $tests,
            );
            $this->output->set_status_header('200');
            $this->output->set_header('Access-Control-Allow-Origin: *');
        } else {
            $json = array(
                'Code'    => '400',
                'Message' => 'No chapter found',
                'Tests'   => $tests,
            );
            $this->output->set_status_header('400');
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
}
