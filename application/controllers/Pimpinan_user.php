<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan_user extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('M_User');
        $this->load->library('form_validation');
    }

	public function get()
	{   
        $data=$this->M_User->getAll();
		echo json_encode($data);
    }

    public function isSame($nama){
		//Check Username Sama?
		$username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
		$same=$this->M_User->isSameName($username);

		if (count($same)==0) {
			//Username Belum Ada
			return TRUE;
		}else{
			//Username Sudah Ada
			return FALSE;
		}
	}

    public function post(){
		$id=htmlspecialchars($this->input->post('id_user',TRUE),ENT_QUOTES);
		
		if($id==''){
			$this->add();
		}else{
			$this->update();
		}
    }
    
    public function add(){
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('level', 'level', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else
		{
			$username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);

			if ($this->isSame($username)==FALSE) {
				echo json_encode(array("message"=>'exist',"status" => FALSE));
			}else{
				$nama_lengkap=htmlspecialchars($this->input->post('nama_lengkap',TRUE),ENT_QUOTES);
				$level=htmlspecialchars($this->input->post('level',TRUE),ENT_QUOTES);
				$password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);

				$data_user = array(
					'nama_lengkap' => $nama_lengkap,
					'username' => $username,
					'level' => $level,
					'password' => md5($password)
				);

				if($this->M_User->addUser($data_user)){
					echo json_encode(array("status" => TRUE));
				}else{
					echo json_encode(array("status" => FALSE));
				}
			}

		}
    }
    
    public function update(){
		$this->form_validation->set_rules('id_user', 'id_user', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
        $this->form_validation->set_rules('username_old', 'username_old', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('level', 'level', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("DIE" =>'HASAN',"status" => FALSE));
		}else{
            $id_user=htmlspecialchars($this->input->post('id_user',TRUE),ENT_QUOTES);
            $username_old=htmlspecialchars($this->input->post('username_old',TRUE),ENT_QUOTES);
            $username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
			$nama_lengkap=htmlspecialchars($this->input->post('nama_lengkap',TRUE),ENT_QUOTES);
            $level=htmlspecialchars($this->input->post('level',TRUE),ENT_QUOTES);
			
			if ($username!=$username_old) {
				if ($this->isSame($username)==FALSE) {
					echo json_encode(array("message"=>'exist',"status" => FALSE));
				}else{
		
					$data_user = array(
                        'nama_lengkap' => $nama_lengkap,
                        'username' => $username,
                        'level' => $level
                    );
		
					if($this->M_User->updateUser($data_user,$id_user)){
						echo json_encode(array("status" => TRUE));
					}else{
						echo json_encode(array("status" => FALSE));
					}
				}
			}else{
				$data_user = array(
                    'nama_lengkap' => $nama_lengkap,
                    'username' => $username,
                    'level' => $level
                );
	
				if($this->M_User->updateUser($data_user,$id_user)){
					echo json_encode(array("status" => TRUE));
				}else{
					echo json_encode(array("status" => FALSE));
				}
			}
		}
    }
    
    public function delete(){

		$this->form_validation->set_rules('id_user', 'id_user', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else{
			$id_user=htmlspecialchars($this->input->post('id_user',TRUE),ENT_QUOTES);

			$insert = $this->M_User->delete($id_user);

			echo json_encode(array("status" => TRUE));
		}
	}
}