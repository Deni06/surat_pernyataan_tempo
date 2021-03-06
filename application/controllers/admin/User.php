<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();

        $count = $this->db->query("SELECT COUNT(1) as count FROM company
        WHERE LOWER(company_name) = LOWER('PT. TEMPO REALTY')")->row();						
        
        if($count->count <= 0){
            $this->session->set_flashdata('error','Invalid Serial Number');    
            redirect('login');  
        }
        
        if($this->session->userdata('is_login') !=  true)
        {
            $this->session->set_flashdata('error','You have no access to that page.');
            redirect('login');  
        }
        $this->load->model('User_model');
        $this->load->model('general_model');
        $this->load->model('user_group_model');
    } 

    /*
     * Listing of users
     */
    function index()
    {
        $this->user_library->checking_page_access('user',"user","view");   
        $data['users'] = $this->User_model->get_all_users();        

        $this->load->view('backend/user/master_user',$data);
    }
    
    function add()
    {   
        $this->user_library->checking_page_access('user',"user","add");   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $where_check_username['user_name'] = $this->input->post('usr_username');   
            $check_username = $this->general_model->get_info("count(1) as count", "ms_user", $where_check_username);                

    if($check_username != FALSE) {        
        if($check_username->row()->count > 0){
            $this->session->set_flashdata('error', 'Username Already Use');                      
            $data['user_group'] = $this->user_group_model->get_all_user_group();
            return $this->load->view('backend/user/add_user', $data);
        }
    }

            $params = array(				
				'stuts' => 1,
				'password' => sha1($this->input->post('usr_password')),
				'user_name' => $this->input->post('usr_username'),
				'usr_address' => $this->input->post('usr_address'),				
				'usr_phone' => $this->input->post('usr_phone'),				
                'usr_fullname' => $this->input->post('usr_fullname'),				
                'usr_email' => $this->input->post('usr_email'),
                'usr_group' => $this->input->post('user_group'),
            );
            
            $user_id = $this->User_model->add_user($params);
            $this->session->set_flashdata('success','Add User Success');    
            redirect('admin/user');
        }
        else
        {            
            $data['user_group'] = $this->user_group_model->get_all_user_group();            
            $this->load->view('backend/user/add_user', $data);
        }
    }  

    /*
     * Editing a user
     */
    function edit($usr_id)
    {   
        $this->user_library->checking_page_access('user',"user","edit");   

        if($usr_id == 1) {
            $this->session->set_flashdata('error', "Maaf Anda Tidak Dapat Mengubah User Admin !");
            redirect('admin/user');
        }

        date_default_timezone_set('Asia/Jakarta');        
        $data['user'] = $this->User_model->get_user($usr_id);
        
        if(isset($data['user']['user_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {                   

                $params = array(                    
                    'usr_address' => $this->input->post('usr_address'),                    
                    'usr_phone' => $this->input->post('usr_phone'),
                    'usr_email' => $this->input->post('usr_email'),
                    'usr_fullname' => $this->input->post('usr_fullname'),
                );

                if($this->input->post('user_group') != "" && $this->input->post('user_group') != null){
                    $params['usr_group'] = $this->input->post('user_group');
                }

                $this->User_model->update_user($usr_id,$params); 
                $this->user_library->reset_login_info(); 
                $this->session->set_flashdata('success','Edit User Success');            
                redirect('admin/user');
            }
            else
            {
                $data['user_group'] = $this->user_group_model->get_all_user_group();                
                $this->load->view('backend/user/edit_user',$data);
            }
        }
        else {
            $this->session->set_flashdata('error','User doesnt exist');    
            redirect('admin/user');
        }        
    } 

    /*
     * Deleting user
     */
    function remove($usr_id)
    {
        $this->user_library->checking_page_access('user',"user","delete");   

        if($usr_id == 1) {
            $this->session->set_flashdata('error', "Maaf Anda Tidak Dapat Menghapus User Admin !");
            redirect('admin/user');
        }

        $user = $this->User_model->get_user($usr_id);

        // check if the user exists before trying to delete it
        if(isset($user['user_id']))
        {
            $this->User_model->delete_user($usr_id);
            $this->session->set_flashdata('success','Delete User Success');                
            redirect('admin/user');
        }
        else {
            $this->session->set_flashdata('error','Delete User Failed');    
            redirect('admin/user');
        }            
    }

    public function View($id){
        $this->user_library->checking_page_access('user',"user","view");   
        $data["me"] = $this->User_model->get_user($id);        
        if(isset($data['me']['user_id']))
        {
            $this->load->view('backend/user/view_user',$data);
        }else{
            $this->session->set_flashdata('error','User doesnt exist');    
            redirect('admin/user');
        }		
	}
    
}
