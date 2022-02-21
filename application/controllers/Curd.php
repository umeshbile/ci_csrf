<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Curd extends CI_Controller{
    public function __constuct(){
        parent::__constuct(); 
        
        
    }

    public function index(){
        
        $this->output->cache('showrecords');
        $this->security->get_csrf_hash();
        $data['title'] ='Curd CSRF';
        $this->load->view('include/header',$data);
        $this->load->view('Curd/index');
        $this->load->view('include/footer');
    }

    // store Data
    public function store(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('position', 'Position', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->load->helper('custom_helper');
        $this->security->get_csrf_hash();
        if($this->form_validation->run() == FALSE){
            $error = [
                'token' => $this->security->get_csrf_hash(),
                'nameErr' => form_error('name'),
                'positionErr' => form_error('position'),
                'emailErr' => form_error('email')
            ];
            echo json_encode($error);
        }else{
            // clean_data is for strip_tags
            $insertData = [
                 'name' => ucwords(clean_data($this->input->post('name'))),
                 'position' =>  ucwords(clean_data($this->input->post('position'))),
                 'email' =>  clean_data($this->input->post('email'))
            ];

            $success = [
                'token' => $this->security->get_csrf_hash(),
                'message' => 'success'
            ];
            $this->load->Model('Crud_model');
            $this->Crud_model->insert($insertData);
            echo json_encode($success);
        }

    }

    // Show data
    public function show(){
        $order_by = "created_at desc";
        $this->load->Model('Crud_model');
        $user_data = $this->Crud_model->fetch('','','',$order_by);
        $data['data']['data'] = array();
        $id = 0;
        $row = 0;
        
        if($user_data != NULL){
            foreach($user_data as $usrdata){
                $token = $this->security->get_csrf_hash();
                $data['data']['data'][$id][] = $usrdata->name;
                $data['data']['data'][$id][] = $usrdata->position;
                $data['data']['data'][$id][] = $usrdata->email;
                $data['data']['data'][$id][] = '
                    <div class="dropdown">
                       <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Action
					  </button>
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                         <a class="dropdown-item edit-data" data-token="'.$token.'" data-toggle="modal"   data-id="'.$usrdata->id.'" data-name="'.$usrdata->name.'" data-position="'.$usrdata->position.'" data-email="'.$usrdata->email.'" title="Edit">Edit</a>
                         <a class="dropdown-item delete-data" data-token="'.$token.'" data-toggle="modal"  data-id="'.$usrdata->id.'" data-name="'.$usrdata->name.'" data-position="'.$usrdata->position.'" data-email="'.$usrdata->email.'" title="Delete" >Delete</a>
                       </div>
                    </div>
                ';

                $id++;
                $row++;
            }
        }
        echo json_encode( $data['data'] );

    }   

    // Update Data
    public function update(){

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('position', 'Position', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->load->helper('custom_helper');
        $this->security->get_csrf_hash();
        if($this->form_validation->run() == FALSE){
            $error = [
                'token' => $this->security->get_csrf_hash(),
                'nameErr' => form_error('name'),
                'positionErr' => form_error('position'),
                'emailErr' => form_error('email')
            ];
            echo json_encode($error);
        }else{

            /* Clean_data go to hepler/custom_helper.php */
            $dpdateData = [
                'name' => ucwords(clean_data($this->input->post('name'))),
                'position' => ucwords(clean_data($this->input->post('position'))),
                'email' => ucwords(clean_data($this->input->post('email')))
            ];
            
            $success = [
                'token' => $this->security->get_csrf_hash(),
                'message' => 'success'
            ];

            $where = ['id' => $this->input->post('id')];
            $this->load->Model('Crud_model');
            $this->Crud_model->update($dpdateData,$where);
            echo json_encode($success);
        }


    }

    public function delete(){
        $where = ['id' => $this->input->post('deleteid')];
        $this->load->Model('Crud_model');
        $this->Crud_model->delete($where);
        $success= [
             'token' => $this->security->get_csrf_hash(),
             'message' => 'success'
        ];
    }

    public function deletecache(){
        $this->output->delete_cache();
    }
}
?>