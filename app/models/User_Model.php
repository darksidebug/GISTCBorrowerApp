<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class User_Model extends CI_Model {

        public function insert($table, $data){
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }

        public function insert_authorize($data){
            $this->db->insert('users', $data);
            return $this->db->insert_id();
        }

        public function user_auth($user_id){
            $this->db->where('uid', $user_id);
            $result = $this->db->get('users');
            if($result->num_rows() == 1){
                return $result->row(0)->id;
            }
            else{
                return false;
            }
        }

        public function lookup_user($id){
            $this->db->where('ID_num', $id);
            $result = $this->db->get('register_borrower');
            if($result->num_rows() == 1){
                return $result->row(0)->id;
            }
            else{
                return false;
            }
        }

        public function sign_in($email, $pass){
            $this->db->where('uid', $email);
            $this->db->where('email_pass', $pass);

            $result = $this->db->get('users');
            if($result->num_rows() > 0){
                return $result->result();
            }
            else{
                return false;
            }
        }

        public function get_borrower($id_num){
            $this->db->where('ID_num', $id_num);
            $query = $this->db->get('register_borrower');
            if($query->num_rows() > 0){
                return $query->result();
            }
            else{
                return false;
            }
        }

        public function get__item_borrower($transact_type, $action, $set_field){
            $this->db->select('*');
            $this->db->from('register_borrower');
            $this->db->join('borrow', 'borrow.ID_num = register_borrower.ID_num');
            $this->db->join('approval', 'approval.id = borrow.id');
            $this->db->where('borrow.transact_type', $transact_type);
            $this->db->where('borrow.action_taken', $action);
            $this->db->where('borrow.set_onOff_history', 'On');
            $this->db->where('approval.set_field', $set_field);
            $this->db->where('MONTH(borrow.date_borrowed)', date('m'));
            $this->db->where('YEAR(borrow.date_borrowed)', date('Y'));
            $query = $this->db->get();
            if(!empty($query)){
                return $query->result();
            }
            else{
                return false;
            }
        }

        public function get__borrowed_items($transact_type, $action, $set_field){
            $this->db->select('*');
            $this->db->from('register_borrower');
            $this->db->join('borrow', 'borrow.ID_num = register_borrower.ID_num');
            $this->db->join('approval', 'approval.id = borrow.id');
            $this->db->where('borrow.transact_type', $transact_type);
            $this->db->where('borrow.action_taken', $action);
            $this->db->where('borrow.set_onOff_history', 'On');
            $this->db->where('approval.set_field', $set_field);
            $this->db->where('MONTH(borrow.date_borrowed)', date('m'));
            $this->db->where('YEAR(borrow.date_borrowed)', date('Y'));
            $query = $this->db->get();
            if(!empty($query)){
                return $query->result();
            }
            else{
                return false;
            }
        }

        public function get__details($id){
            $this->db->where('ID_num', $id);
            $query = $this->db->get('register_borrower');
            if($query->num_rows() > 0){
                return $query->result();
            }
            else{
                return false;
            }
        }

        public function query_authorize($user_id, $pass){
            $this->db->where('uid', $user_id);
            $this->db->where('email_pass', $pass);

            $result = $this->db->get('users');
            if($result->num_rows() == 1){
                return $result->row(0)->id;
            }
            else{
                return false;
            }
        }

        public function insert_borrowed_items($table, $data){
            $this->db->insert($table, $data);
            return $this->db->row();
            
        }

        public function insert_borrowed_forApproval($table, $data){
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }

        public function query($table ,$id){
            $this->db->where('id', $id);
            $result = $this->db->get($table);
            if($result->num_rows() == 1){
                return $result->result();
            }
            else{
                return false;
            }
        }

        public function return_borrow($id_num, $code, $data){
            $this->db->where('ID_num', $id_num);
            $this->db->where('code', $code);
            $this->db->set($data);
            $query = $this->db->update('borrow'); 
            if($query){
                return true;
            }
            else{
                return false;
            }
        }

        public function update_borrow_approval($id_num, $type, $data){
            $this->db->where('id', $id_num);
            $this->db->where('transact_type', $type);
            $this->db->set($data);
            $query = $this->db->update('approval'); 
            if($query){
                return true;
            }
            else{
                return false;
            }
        }

        public function cancel_borrow_approval($id_num, $type, $data){
            $this->db->where('id', $id_num);
            $this->db->where('transact_type', $type);
            $this->db->set($data);
            $query = $this->db->update('approval'); 
            if($query){
                return true;
            }
            else{
                return false;
            }
        }

        public function by_month($month){
            $this->db->select('*');
            $this->db->from('register_borrower');
            $this->db->join('borrow', 'borrow.ID_num = register_borrower.ID_num');
            $this->db->join('approval', 'approval.id = borrow.id');
            $this->db->where('approval.set_field', 'pending');
            $this->db->where('MONTH(borrow.date_borrowed)', $month);
            $this->db->where('YEAR(borrow.date_borrowed)', date('Y'));
            $query = $this->db->get();
            if(!empty($query)){
                return $query->result();
            }
            else{
                return false;
            }
        }

        public function get__borrower_details($id, $action_taken, $set_field){
            $this->db->select('*');
            $this->db->from('register_borrower');
            $this->db->join('borrow', 'borrow.ID_num = register_borrower.ID_num');
            $this->db->join('approval', 'approval.id = borrow.id');
            $this->db->where('approval.set_field', $set_field);
            $query_result = $this->db->get();
            return $query_result->result();
        }

        public function get__borrower_allDetails($transact_type){
            $this->db->select('*');
            $this->db->from('register_borrower');
            $this->db->join('borrow', 'borrow.ID_num = register_borrower.ID_num');
            $this->db->join('approval', 'approval.id = borrow.id');
            $this->db->where('borrow.transact_type', $transact_type);
            $this->db->order_by('approval.set_field, register_borrower.name, borrow.date_borrowed asc'); 
            $query = $this->db->get();
            if(!empty($query)){
                return $query->result();
            }
            else{
                return false;
            }
        }

        public function get__reports(){
            $this->db->select('*');
            $this->db->from('register_borrower');
            $this->db->join('borrow', 'borrow.ID_num = register_borrower.ID_num');
            $this->db->join('approval', 'approval.id = borrow.id');
            // $this->db->where('borrow.date_returned', 'null');
            // $this->db->order_by('approval.set_field, register_borrower.name, borrow.date_borrowed asc'); 
            $query = $this->db->get();
            if(!empty($query)){
                return $query->result();
            }
            else{
                return false;
            }
        }

    }