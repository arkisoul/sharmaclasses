<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chapter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('subject_model');
        $this->load->model('chapter_model');
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
        $this->chapterConfig = array(
            array(
                'field'  => 'name',
                'label'  => 'Chapter',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field} name',
                ),
            ),
            array(
                'field'  => 'name_hindi',
                'label'  => 'Chapter',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field} name in Hindi',
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
                'field'  => 'content',
                'label'  => 'Description',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must provide {field} for the chapter',
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
                $chapters = $this->chapter_model->getChaptersBySubjectId($id);
                if ($chapters) {
                    $html  = '';
                    $count = 1;
                    foreach ($chapters as $chapter) {
                        $html .= '<tr id="data_' . $chapter['id'] . '">';
                        $html .= '<td>' . $count . '</td>';
                        $html .= '<td>' . $chapter['name'] . '</td>';
                        $html .= '<td>' . $chapter['content'] . '</td>';
                        $html .= '<td><button class="btn btn-danger" data-id="' . $chapter['id'] . '" data-base="' . base_url() . '" data-item="chapter" data-action="remove" data-toggle="modal" data-target="#confirmationModal"> <i class="fa fa-trash"></i></button></a><a class="btn btn-primary" href="' . base_url() . 'chapter/edit/' . $chapter['id'] . '" ><i class="fa fa-pencil"></i></a></td>';
                        $count++;
                    }
                    $json = array(
                        'code'    => '200',
                        'objects' => $html,
                    );
                } else {
                    $json = array(
                        'code'    => '400',
                        'objects' => '<tr><td colspan="4" class="text-center">No chapter added in this subject</td></tr>',
                    );
                }
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($json));
            } else {
                $this->data['chapters'] = [];
                $this->data['subjects'] = $this->subject_model->getAll();
                $this->data['title']    = 'Chapters';
                $this->load->view('header', $this->data);
                $this->load->view('chapter/index');
                $this->load->view('footer');
            }
        }
    }

    public function add()
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->chapterConfig);

            if (!$this->form_validation->run()) {
                $this->data['subjects'] = $this->subject_model->getAll();
                $this->data['title']    = 'Add Chapter';
                $this->load->view('header', $this->data);
                $this->load->view('chapter/add');
                $this->load->view('footer');

                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'name'       => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
                            'name_hindi' => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                            'content'    => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
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

                if ($this->chapter_model->add($data)) {
                    addFirebase($this->admin_model->fcmIds(), $this->chapter_model->getById($this->chapter_model->getInsertId()), 2, 'A new chapter added');
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
            $chapter = $this->chapter_model->getById($id);
            if ($this->chapter_model->delete($id)) {
                deleteFirebase($this->admin_model->fcmIds(), $chapter, 2, 'A chapter deleted');
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
            $chapter                = $this->chapter_model->getById($id);
            $this->data['subjects'] = $this->subject_model->getAll();
            $this->data['chapter']  = $chapter[0];
            $this->data['title']    = 'Edit Chapter';
            $this->load->view('header', $this->data);
            $this->load->view('chapter/edit');
            $this->load->view('footer');
        }
    }

    public function update($id)
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->chapterConfig);

            if (!$this->form_validation->run()) {
                $chapter                = $this->chapter_model->getById($id);
                $this->data['subjects'] = $this->subject_model->getAll();
                $this->data['chapter']  = $chapter[0];
                $this->data['title']    = 'Edit Chapter';
                $this->load->view('header', $this->data);
                $this->load->view('chapter/edit');
                $this->load->view('footer');
                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'name'       => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
                            'name_hindi' => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
                            'content'    => form_error('name_hindi', '<p class="mt-3 text-danger">', '</p>'),
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

                if ($this->chapter_model->update($id, $data)) {
                    editFirebase($this->admin_model->fcmIds(), $this->chapter_model->getById($id), 2, 'A chapter updated');
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

    public function getChapters()
    {
        $chapters = $this->chapter_model->getAll();
        if ($chapters) {
            $json = array(
                'Code'     => '200',
                'Message'  => 'Chapters list',
                'Chapters' => $chapters,
            );
            $this->output->set_status_header('200');
            $this->output->set_header('Access-Control-Allow-Origin: *');
        } else {
            $json = array(
                'Code'     => '400',
                'Message'  => 'No chapter found',
                'Chapters' => $chapters,
            );
            $this->output->set_status_header('400');
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
}
