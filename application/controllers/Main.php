<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller{
    public function __consturct(){
        parent::__construct();
    }

    public function index(){
        $data['title'] ="CI CURD";
        $this->load->view("main/index",$data);
    }
}