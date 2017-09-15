<?php
	class Admin extends CI_Controller {
		var $data;

		function __construct() {
			parent::__construct();

			$this->data['countMember'] = $this->db->count_all_results('member');
			$this->data['countAdmin'] = $this->db->count_all_results('admin');
			$this->data['countUser'] = $this->data['countMember'] + $this->data['countAdmin'];
			$this->data['countPost'] = $this->db->count_all_results('photo');
			$this->db->where('loggedIn', 1);
			$this->data['countLoggedIn'] = $this->db->count_all_results('member');
			$this->db->where('is_published', 0);
			$this->data['countPostApprovals'] = $this->db->count_all_results('photo');
			$this->db->where('is_published', 1);
			$this->data['countPostPublished'] = $this->db->count_all_results('photo');
			$this->data['countPost'] = $this->data['countPostApprovals'] + $this->data['countPostPublished'];
			$this->data['admin'] = $this->db->get('admin')->result_array();
		}
		public function index() {
			$data = $this->data;
			$data['title'] = 'Dashboard | IMS Grid Admin';
			$data['activePage'] = 'dashboard';

			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/pages/dashboard_view');
			$this->load->view('templates/admin/footer');
		}

		public function updateAdmin($id) {
			if($this->input->post('password'))
				$data = array(
					'username' => $this->input->post('username'),
					'first_name' => $this->input->post('fname'),
					'last_name' => $this->input->post('lname'),
					'password' => md5($this->input->post('password'))
				);
			else
				$data = array(
					'username' => $this->input->post('username'),
					'first_name' => ucfirst(strtolower($this->input->post('fname'))),
					'last_name' => ucfirst(strtolower($this->input->post('lname'))),
				);

			$this->db->where('id_admin', $id);
			$update = $this->db->update('admin', $data);

			if($update) {
				$userdata = array(
					'username' => $this->input->post('username'),
					'name' => $this->input->post('fname').' '.$this->input->post('lname'),
				);

				$this->session->set_userdata($userdata);

				redirect('admin');
			} else {
				echo 'failed';
			}
		}

		public function login() {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[20]|min_length[6]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|min_length[8]');

      $this->form_validation->set_error_delimiters('<span class="help-block">', "</span>");

			if(!$this->form_validation->run()) {
				$data['title'] = "Log In | IMS Grid Admin";

				$this->load->view('templates/admin/header_nonav', $data);
				$this->load->view('admin/user/login_view');
				$this->load->view('templates/admin/footer_nofoot');
			} else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$data['user'] = $this->Admin_Model->adminLogin($username, $password);

				if(!empty($data['user'])) {
					$userdata = array(
						'userId' => $data['user']['id_user'],
						'avatarFileName' => 'avatar_default.jpg',
						'username' => $data['user']['username'],
						'name' => $data['user']['first_name'].' '.$data['user']['last_name'],
						'createDate' => $data['user']['create_date_time'],
						'userLoggedIn' => true
					);

					$this->session->set_userdata($userdata);

					redirect('admin');
				} else {
					$this->session->set_flashdata('adminLoginFailed', 'Username or password is incorrect.');

					redirect('admin/login');
				}
			}
		}

		public function logout() {
			$userdata = array('userId', 'username', 'userFirstName', 'userLastName', 'userLoggedIn');

			$this->session->unset_userdata($userdata);
			$this->session->sess_destroy();

			redirect('admin/login');
		}

		public function dashboardMembers() {
			$data = $this->data;
			$data['members'] = $this->Member_Model->getMembers();

			$data['title'] = 'Members | IMS Grid Admin';
			$data['activePage'] = 'members';

			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/pages/members_view', $data);
			$this->load->view('templates/admin/footer');
		}

		public function postApprovals() {
			$data = $this->data;

			$this->db->where('is_published', 0);
			$data['posts'] = $this->Photo_Model->getUnpublishedPosts();

			$data['title'] = 'Post Approvals | IMS Grid Admin';
			$data['activePage'] = 'postapprovals';

			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/pages/post_approval_view', $data);
			$this->load->view('templates/admin/footer');
		}

		public function approvePost($postId) {
			$data = array('is_published' => 1);
			$this->db->where('id_photo', $postId);
			$this->db->update('photo', $data);

			if($this->db->affected_rows() > 0) {
				redirect('admin/posts/approvals');
			} else {
				echo 'fail';
			}
		}

		public function publishedPosts() {
			$data = $this->data;

			$data['posts'] = $this->Photo_Model->getPosts();

			$data['title'] = 'Published Posts | IMS Grid Admin';
			$data['activePage'] = 'approvedposts';

			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/pages/posts_view', $data);
			$this->load->view('templates/admin/footer');
		}

		public function delete() {
			$memberId = $this->input->post('id');
			if($this->Admin_Model->memberDeleteAccount($memberId))
				redirect('admin/users/members');
			else
				redirect('admin/users/members');
		}
	}
?>