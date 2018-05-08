<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('test_model');
        $this->load->model('question_model');
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
        $this->queConfig = array(
            array(
                'field'  => 'test_id',
                'label'  => 'Test',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'You must select a {field} name',
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
                $questions = $this->question_model->getQueByTestId($id);
                if ($questions) {
                    $html  = '';
                    $count = 1;
                    foreach ($questions as $question) {
                        $html .= '<tr id="data_' . $question['id'] . '">';
                        $html .= '<td>' . $count . '</td>';
                        $html .= '<td>' . $question['que_eng'] . '</td>';
                        $html .= '<td class="hindi-text">' . $question['que_hindi'] . '</td>';
                        $html .= '<td><button class="btn btn-danger" data-id="' . $question['id'] . '" data-base="' . base_url() . '" data-item="question" data-action="remove" data-toggle="modal" data-target="#confirmationModal"> <i class="fa fa-trash"></i></button></a><a class="btn btn-primary" href="' . base_url() . 'question/edit/' . $question['id'] . '" ><i class="fa fa-pencil"></i></a></td>';
                        $count++;
                    }
                    $json = array(
                        'code'    => '200',
                        'objects' => $html,
                    );
                } else {
                    $json = array(
                        'code'    => '400',
                        'objects' => '<tr><td colspan="4" class="text-center">No question added in this test</td></tr>',
                    );
                }
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($json));
            } else {
                $this->data['questions'] = [];
                $this->data['tests']     = $this->test_model->getAll();
                $this->data['title']     = 'Questions';
                $this->load->view('header', $this->data);
                $this->load->view('question/index');
                $this->load->view('footer');
            }
        }
    }

    public function add()
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->queConfig);

            if (!$this->form_validation->run()) {
                $this->data['tests'] = $this->test_model->getAll();
                $this->data['title'] = 'Add Question';
                $this->load->view('header', $this->data);
                $this->load->view('question/add');
                $this->load->view('footer');

                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'test_id' => form_error('test_id', '<p class="mt-3 text-danger">', '</p>'),
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

                if ($this->question_model->add($data)) {
                    addFirebase($this->admin_model->fcmIds(), $this->question_model->getById($this->question_model->getInsertId()), 4, 'A new question added');
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
            $question = $this->question_model->getById($id);
            if ($this->question_model->delete($id)) {
                deleteFirebase($this->admin_model->fcmIds(), $question, 4, 'A question deleted');
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
            $question               = $this->question_model->getById($id);
            $this->data['tests']    = $this->test_model->getAll();
            $this->data['question'] = $question[0];
            $this->data['title']    = 'Edit Question';
            $this->load->view('header', $this->data);
            $this->load->view('question/edit');
            $this->load->view('footer');
        }
    }

    public function update($id)
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->queConfig);

            if (!$this->form_validation->run()) {
                $question               = $this->question_model->getById($id);
                $this->data['tests']    = $this->test_model->getAll();
                $this->data['question'] = $question[0];
                $this->data['title']    = 'Edit Question';
                $this->load->view('header', $this->data);
                $this->load->view('question/edit');
                $this->load->view('footer');

                if (validation_errors()) {
                    $json = array(
                        'code'  => '401',
                        'error' => array(
                            'test_id' => form_error('test_id', '<p class="mt-3 text-danger">', '</p>'),
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

                if ($this->question_model->update($id, $data)) {
                    editFirebase($this->admin_model->fcmIds(), $this->question_model->getById($id), 4, 'A question updated');
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

    public function imgUpload()
    {
        $config['upload_path']      = './attachments/question-images';
        $config['max_size']         = '8000';
        $config['file_ext_tolower'] = true;
        $config['allowed_types']    = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $data = array('upload_data' => $this->upload->data());
            $json = array(
                'code'     => '200',
                'path'     => base_url() . 'attachments/question-images/' . $data['upload_data']['file_name'],
                'filename' => $data['upload_data']['file_name'],
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($json));
        } else {
            $json = array(
                'code'  => '400',
                'error' => $this->upload->display_errors(),
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($json));
        }
    }

    public function import()
    {
        if (!$this->session->__get('user')) {
            $this->load->view('login');
        } else {
            $this->form_validation->set_rules($this->queConfig);

            if (!$this->form_validation->run()) {
                $this->data['tests'] = $this->test_model->getAll();
                $this->data['title'] = 'Import Questions';
                $this->load->view('header', $this->data);
                $this->load->view('question/import');
                $this->load->view('footer');
            } else {
                $config['upload_path']   = './attachments/question-files';
                $config['allowed_types'] = 'xls|xlsx|csv|txt';
                $config['max_size']      = '8000';
                $this->load->library('upload', $config);
                $test_id = $this->input->post('test_id');

                if ($this->upload->do_upload('q_file')) {
                    $upload_data = $this->upload->data();
                    $full_path   = $upload_data['full_path'];
                    $this->load->helper('unicode_converter');

                    convert_file_to_utf8($full_path);

                    $lines = file($full_path);

                    $batch_data = array();

                    foreach ($lines as $line_num => $line) {
                        $tbl_values = explode("\t", $line);

                        $data = array(
                            'test_id'    => $test_id,
                            'que_hindi'  => isset($tbl_values[0]) ? $tbl_values[0] : "",
                            'opt1_hindi' => isset($tbl_values[2]) ? $tbl_values[2] : "",
                            'opt2_hindi' => isset($tbl_values[4]) ? $tbl_values[4] : "",
                            'opt3_hindi' => isset($tbl_values[6]) ? $tbl_values[6] : "",
                            'opt4_hindi' => isset($tbl_values[8]) ? $tbl_values[8] : "",
                            'ans_hindi'  => isset($tbl_values[10]) ? $tbl_values[10] : "",
                            'que_eng'    => isset($tbl_values[1]) ? $tbl_values[1] : "",
                            'opt1_eng'   => isset($tbl_values[3]) ? $tbl_values[3] : "",
                            'opt2_eng'   => isset($tbl_values[5]) ? $tbl_values[5] : "",
                            'opt3_eng'   => isset($tbl_values[7]) ? $tbl_values[7] : "",
                            'opt4_eng'   => isset($tbl_values[9]) ? $tbl_values[9] : "",
                            'ans_eng'    => isset($tbl_values[10]) ? $tbl_values[10] : "",
                            'is_active'  => 1,
                            'image'      => '',
                        );

                        array_push($batch_data, $data);
                    }

                    $this->question_model->addBatch($batch_data);

                    $json = array(
                        'code'  => '200',
                        'count' => $this->question_model->getRows(),
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                } else {
                    $json = array(
                        'code'  => '400',
                        'error' => $this->upload->display_errors(),
                    );
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($json));
                }
            }
        }
    }

    public function downloadInstructions($filename = 'attachments/instructions/instructions.docx')
    {
        $filedata = @file_get_contents($filename);

        // SUCCESS
        if ($filedata) {
            // GET A NAME FOR THE FILE
            $basename = basename($filename);

            // THESE HEADERS ARE USED ON ALL BROWSERS
            header("Content-Type: application-x/force-download");
            header("Content-Disposition: attachment; filename=$basename");
            header("Content-length: " . (string) (strlen($filedata)));
            header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

            // THIS HEADER MUST BE OMITTED FOR IE 6+
            if (false === strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE ')) {
                header("Cache-Control: no-cache, must-revalidate");
            }

            // THIS IS THE LAST HEADER
            header("Pragma: no-cache");

            // FLUSH THE HEADERS TO THE BROWSER
            flush();

            // CAPTURE THE FILE IN THE OUTPUT BUFFERS - WILL BE FLUSHED AT SCRIPT END
            ob_start();
            echo $filedata;
        }

        // FAILURE
        else {
            die("ERROR: UNABLE TO OPEN $filename");
        }
    }

    public function getQuestions()
    {
        $questions = $this->question_model->getAll();
        if ($questions) {
            $json = array(
                'Code'      => '200',
                'Message'   => 'questions list',
                'Questions' => $questions,
            );
            $this->output->set_status_header('200');
            $this->output->set_header('Access-Control-Allow-Origin: *');
        } else {
            $json = array(
                'Code'      => '400',
                'Message'   => 'No chapter found',
                'Questions' => $questions,
            );
            $this->output->set_status_header('400');
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
}
