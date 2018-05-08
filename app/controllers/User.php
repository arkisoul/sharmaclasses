<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('sms');
    }

    public function insert()
    {
        $json_obj = json_decode($this->input->raw_input_stream);
        $this->output->set_header('Access-Control-Allow-Origin: *');

        if (!property_exists($json_obj, 'mobile_number')) {
            $json = array(
                'Code'    => '403',
                'Message' => 'Mobile number is required',
            );
            $this->output->set_status_header('403');
        } elseif (!property_exists($json_obj, 'fcm_id')) {
            $json = array(
                'Code'    => '403',
                'Message' => 'FCM ID is required',
            );
            $this->output->set_status_header('403');
        } else {
            $data = array(
                'mobile'   => $json_obj->mobile_number,
                'fcm_id'   => $json_obj->fcm_id,
                'name'     => '',
                'email'    => '',
                'password' => '',
                'type'     => '',
            );
            if ($this->user_model->insert($data)) {
                $json = array(
                    'Code'    => '201',
                    'Message' => 'User created successfully',
                );
                $this->output->set_status_header('201');

            } else {
                $json = array(
                    'Code'    => '401',
                    'Message' => 'Can\'t create user, try again later.',
                );
                $this->output->set_status_header('400');
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function otp()
    {
        $json_obj = json_decode($this->input->raw_input_stream);
        $this->output->set_header('Access-Control-Allow-Origin: *');

        if (!property_exists($json_obj, 'mobile')) {
            $json = array(
                'Code'    => '403',
                'Message' => 'Mobile number is required',
            );
            $this->output->set_status_header('403');
        } else {
            $mobile = $json_obj->mobile;
            $otp    = rand(100000, 999999);
            $md5    = md5($otp);
            $msg    = "Your One Time Activation Code for Sharma Quiz App is  " . $otp;

            $url     = smsURL($mobile, $msg);
            $openURL = openURL($url);

            $sms_success = substr($openURL, 0, 4);

            if ($sms_success == 1701) {
                $json = array(
                    'Code'    => '200',
                    'Message' => 'OTP sent successfully',
                    'OTP'     => $md5,
                );
                $this->output->set_status_header('200');
            } else {
                $json = array(
                    'Code'    => '403',
                    'Message' => 'Can\'t send OTP, try again later',
                );
                $this->output->set_status_header('403');
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
}
