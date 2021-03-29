<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class User extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('session');
            $this->load->model('User_Model');
            $this->load->helper('date');
            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
            $this->output->set_header("Pragma: no-cache"); 
        }

        public function register(){
            
            if($_POST['register'] == 'register'){
                
                $id               = $this->input->post('id');
                $return_result_id = $this->User_Model->lookup_user($id);
                if($return_result_id == false){
                    $data = array(
                        'ID_num'       => $this->input->post('id'),
                        'name'         => $this->input->post('name'),
                        'dept'         => $this->input->post('dept'),
                        'contact'      => $this->input->post('contact')
                    );
                    $returnedLast_inserted_id = $this->User_Model->insert('register_borrower', $data);
                    if($returnedLast_inserted_id){
                        $user_data = array(
                            'last_inserted_id'   => $return_result_id,
                            'allowed'            => 'yes',
                            'msg'                => 'Borrower successfully registered.',
                            'registered'         => true
                        );
                     
                    }
                    else{
                        $user_data = array(
                            'last_inserted_id'   => $return_result_id,
                            'allowed'            => 'not',
                            'msg'                => 'Something went wrong in registration.',
                            'registered'         => false
                        );
                    } 
                }
                else{
                    $user_data = array(
                        'last_inserted_id'   => $return_result_id,
                        'allowed'            => 'no',
                        'msg'                => 'School ID already taken. Please choose another one.',
                        'registered'         => false
                    );
                }

                echo json_encode($user_data);
            }
            else{
                redirect('pages/register');
            }
        }

        public function login(){
            if($_POST['login'] == 'users'){
                $email              = $this->input->post('email');
                $password           = $this->input->post('password');
                $encrypted_password = md5($password);
                $return_result_id = $this->User_Model->sign_in($email, $encrypted_password);
                if($return_result_id){
                    foreach ($return_result_id as $key => $value) {
                        $user_data = array(
                            'user_id'   => $return_result_id,
                            'username'  => $email,
                            'position'  => $value->position,
                            'msg'       => 'Welcome "'.$email.'". You are now logged in.',
                            'logged_in' => true
                        );
                    }
                    $this->session->set_userdata($user_data);
                }
                else{
                    $user_data = array(
						'user_id'   => 0,
                        'username'  => '',
                        'position'  => '',
                        'msg'       => 'User id "'.$email.'" does not exists!',
						'logged_in' => false
					);
                    $this->session->set_userdata($user_data);
                }

                echo json_encode($user_data);
            }
            else{
                redirect('pages/login');
            }
        }

        public function register_authorize(){
            if($_POST['register_userauth'] == 'users_auth'){
                $user_id             = $this->input->post('user_id');
                $return_result_query = $this->User_Model->user_auth($user_id);
                if($return_result_query == false){
                    $data = array(
                        'uid'            => $this->input->post('user_id'),
                        'name'           => $this->input->post('name'),
                        'position'       => $this->input->post('position'),
                        'email_pass'     => md5($this->input->post('password'))
                    );
                    $returnedLast_inserted_id = $this->User_Model->insert_authorize($data);
                    if($returnedLast_inserted_id){
                        $user_data = array(
                            'user_id'   => $returnedLast_inserted_id,
                            'username'  => $user_id,
                            'msg'       => 'User Successfully registered.',
                            'registered'=> true,
                            'allowed'   => 'yes'
                        );
                    }
                    else{
                        $user_data = array(
                            'user_id'   => 0,
                            'username'  => $user_id,
                            'msg'       => 'User cannot be inserted.',
                            'registered'=> false,
                            'allowed'   => 'no'
                        );
                    }
                }
                else{
                    $user_data = array(
						'user_id'   => $return_result_query,
						'username'  => $user_id,
                        'msg'       => 'User already registered.',
                        'registered'=> false,
                        'allowed'   => 'not'
                    );
                }
                echo json_encode($user_data);
            }
            else{
                redirect('pages/register_auth/');
            }
        }

        public function get_borrower(){
            if($_POST['get__borrower_data'] == 'get__borrower_data'){
                $id_num        = $this->input->post('id_num');
                $return_result = $this->User_Model->get_borrower($id_num);
                if($return_result){
                    foreach ($return_result as $key) {
                        $borrower_data = array(
                            'borrower_name'      => $key->name,
                            'borrower_dept'      => $key->dept,
                            'borrower_cont'      => $key->contact,
                            'data_set'           => true
                        );
                    }
                }
                else{
                    $borrower_data = array(
                        'data_set' => false,
                        'msg'      => 'Borrower not registered. Register now?'
                    );
                }
                echo json_encode($borrower_data);
            }
        }

        public function get__equipment_borrower(){
            if($_POST['get_data'] == 'get__equipment_borrower'){
                $transact_type = $this->input->post('transact_type');
                $action        = $this->input->post('action');
                $return_result = $this->User_Model->get__item_borrower($transact_type, $action);
            }
            else{
                $return_result = "";
            }
            echo json_encode($return_result);
        }

        public function get__document_borrower(){
            if($_POST['get_data'] == 'get__document_borrower'){
                $transact_type = $this->input->post('transact_type');
                $action        = $this->input->post('action');
                $return_result = $this->User_Model->get__item_borrower($transact_type, $action);
                echo json_encode($return_result);
            }
        }

        public function borrow_items(){
            if($_POST['borrow'] == 'borrow_items'){
                $email              = $this->input->post('uid');
                $password           = $this->input->post('password');
                $encrypted_password = md5($password);
                $return_result_id = $this->User_Model->sign_in($email, $encrypted_password);
                if($return_result_id){
                    $data = array(
                        'transact_type'       => $this->input->post('transact_choice'),
                        'ID_num'              => $this->input->post('id_num'),
                        'date_borrowed'       => $this->input->post('dateborrowed'),
                        'date_to_returned'    => $this->input->post('dateToreturn'),
                        'code'                => $this->input->post('code'),
                        'model_num'           => $this->input->post('model__num'),
                        'item_name'           => $this->input->post('doc_name'),
                        'description'         => $this->input->post('desc'),
                        'quantity'            => $this->input->post('quantity'),
                        'auth_by_uid'          => $this->input->post('uid'),
                        'auth_by_pass'        => $encrypted_password,
                        'action_taken'        => 'not_returned',
                        'set_onOff_history'   => 'On'
                    );
                    $returnedLast_inserted = $this->User_Model->insert('borrow', $data);
                    if($returnedLast_inserted){
                        $row = $this->User_Model->query('borrow', $returnedLast_inserted);
                        foreach ($row as $key => $value) {
                            $new_data = array(
                                'id'             => $returnedLast_inserted,
                                'transact_type'  => $value->transact_type,
                                'borrower_id'    => $value->ID_num,
                                'set_field'      => 'pending'
                            );
                        }
                        
                        $this->User_Model->insert('approval', $new_data);
                        $user_data = array(
                            'msg'        => 'Data save successfully!',
                            'registered' => true
                        );
                    }
                    else{
                        $user_data = array(
                            'msg'       => 'Data cannot be inserted.',
                            'registered'=> false
                        );
                    }
                }
                else{
                    $user_data = array(
						'user_id'   => 0,
						'username'  => $email,
                        'msg'       => 'User authentication invalid!',
						'registered' => false
					);
                }

                echo json_encode($user_data);
            }
            else{
                redirect('pages/login');
            }
        }

        public function return_items(){
            if($_POST['returned'] == 'return_items'){
                $email              = $this->input->post('uid');
                $password           = $this->input->post('password');
                $encrypted_password = md5($password);
                $return_result_id = $this->User_Model->sign_in($email, $encrypted_password);
                if($return_result_id){
                    $id_num = $this->input->post('id_num');
                    $code   = $this->input->post('code');
                    $data = array(
                        'date_returned'      => $this->input->post('dateReturn'),
                        'action_taken'       => 'returned',
                        'set_onOff_history'  => 'Off'
                    );
                    $returned_query = $this->User_Model->return_borrow($id_num, $code, $data);
                    if($returned_query){
                        $id             = $this->input->post('id');
                        $transact_type  = $this->input->post('transact_type');
                        $data_cancel = array(
                            'set_field'      => 'returned'
                        );
                        $result = $this->User_Model->cancel_borrow_approval($id, $transact_type, $data_cancel);
                        if($result){
                            $user_data = array(
                                'transact'   => 'successful' ,
                                'msg'        => 'Item/Document cancelled!',
                                'returned'   => true
                            );
                        }
                    }
                    else{
                        $user_data = array(
                            'transact'   => 'failed' ,
                            'msg'        => 'Item/Document returned failed!',
                            'returned'   => false
                        );
                    }
                }
                else{
                    $user_data = array(
                        'transact' => $return_result_id ,
                        'msg'       => 'Not allowed.',
                        'registered' => false
                    );
                }
                echo json_encode($user_data);
            }
        }

        public function cancel_items(){
            if($_POST['cancelled'] == 'cancel'){
                $email              = $this->input->post('uid');
                $password           = $this->input->post('password');
                $encrypted_password = md5($password);
                $return_result_id = $this->User_Model->sign_in($email, $encrypted_password);
                if($return_result_id){
                    $id_num = $this->input->post('id_num');
                    $code   = $this->input->post('code');
                    $data = array(
                        'date_returned'      => $this->input->post('dateReturn'),
                        'action_taken'       => 'cancelled',
                        'set_onOff_history'  => 'Off'
                    );
                    $returned_query = $this->User_Model->return_borrow($id_num, $code, $data);
                    if($returned_query){
                        $id             = $this->input->post('id');
                        $transact_type  = $this->input->post('transact_type');
                        $data_cancel = array(
                            'set_field'      => 'cancelled'
                        );
                        $result = $this->User_Model->cancel_borrow_approval($id, $transact_type, $data_cancel);
                        if($result){
                            $user_data = array(
                                'transact'   => 'successful' ,
                                'msg'        => 'Item/Document cancelled!',
                                'returned'   => true
                            );
                        }
                    }
                    else{
                        $user_data = array(
                            'transact'   => 'failed' ,
                            'msg'        => 'Item/Document cancel failed!',
                            'returned'   => false
                        );
                    }
                }
                else{
                    $user_data = array(
                        'transact' => $return_result_id ,
                        'msg'       => 'Not allowed.',
                        'registered' => false
                    );
                }
                echo json_encode($user_data);
            }
        }

        public function borrow_approval(){
            if($_POST['approved'] == 'approved'){
                $id   = $this->input->post('id');
                $type = $this->input->post('type');
                $data = array(
                    'approval_u_id'           => $this->input->post('uid'),
                    'approval_u_position'     => $this->input->post('position'),
                    'time_approval'           => (date("Y-m-d")." ".date("H:i:s")),
                    'set_field'               => 'approved'
                );
                $return_result = $this->User_Model->update_borrow_approval($id, $type, $data);
                if($return_result){
                    $user_data = array(
                        'msg'        => "Approval complete!",
                        'approved'   => true
                    );
                }
                else{
                    $user_data = array(
                        'msg'       => 'Not allowed.',
                        'approved'  => false
                    );
                }
                echo json_encode($user_data);
            }
        }

        public function denied_approval(){
            if($_POST['denied'] == 'denied'){
                $id   = $this->input->post('id');
                $type = $this->input->post('type');
                $data = array(
                    'approval_u_id'           => $this->input->post('uid'),
                    'approval_u_position'     => $this->input->post('position'),
                    'time_approval'           => (date("Y-m-d")." ".date("H:i:s")),
                    'set_field'               => 'denied'
                );
                $return_result = $this->User_Model->update_borrow_approval($id, $type, $data);
                if($return_result){
                    $user_data = array(
                        'msg'        => "Borrow denied !",
                        'approved'   => true
                    );
                }
                else{
                    $user_data = array(
                        'msg'       => 'Not allowed.',
                        'approved'  => false
                    );
                }
                echo json_encode($user_data);
            }
        }

        public function query_by_month(){
            if($_POST["query"] == "monthly"){
                $month   = $this->input->post('month');
                $return_result = $this->User_Model->by_month($month);
                if($return_result){
                    
                    $user_data = array(
                        'data'     => $return_result,
                        'query'   => true
                    );
                }
                else{
                    $user_data = array(
                        'msg'    => $return_result,
                        'query'  => false
                    );
                }
                echo json_encode($user_data);
            }
        }

        public function monthly(){
            if($_POST["by_month"] == "monthly"){
                $month   = $this->input->post('month');
                $return_result = $this->User_Model->by_month($month);
                if($return_result){
                    
                    $user_data = array(
                        'data'     => $return_result,
                        'query'   => true
                    );
                }
                else{
                    $user_data = array(
                        'msg'    => $return_result,
                        'query'  => false
                    );
                }
                echo json_encode($user_data);
            }
        }

        public function logout(){
            $this->session->sess_destroy();
            redirect('pages/login/');
        }

    }