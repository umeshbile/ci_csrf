<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crud_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->table = 'user';
    }

    public function fetch($where="",$limit="",$offset="",$order="" ){
        
         $this->db->cache_on();
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($limit)){
            if(!empty($offset)){
                $this->db->limit($limit,$offset);
            }else{
                $this->db->limit($limit);
            }
        }

        if(!empty($order)){
            $this->db->order_by($order);
        }
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function insert($data){
        $this->db->cache_delete('curd','show');
        $result = $this->db->insert($this->table,$data);
        return $result = true ? true : false;
    }

    public function update($data, $where){
        $this->db->cache_delete('curd','show');
            if($where != ''){
                $this->db->where($where);
            }
            $result = $this->db->update($this->table,$data);
            return $result = true ? true : false;
    }

    public function delete($where){
        $this->db->cache_delete('curd','show');
        if($where != ''){
            $this->db->where($where);
        }

        $result = $this->db->delete($this->table,$where);
        return $result = true ? true : false;
    }
}