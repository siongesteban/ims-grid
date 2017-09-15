<?php
  /**
   * Member Controller
   * @author Jerico Esteban
   */
  class Member extends CI_Controller {
    function __construct() {
      parent::__construct();

      $data['desc'] = '';
    }

    /**
     * View member profile page with the slug (member id).
     * The user will be redirected to member list if there's
     * no slug provided.
     * @param string $slug
     */
    public function index($slug = NULL) {
      if($slug == NULL) {
        redirect('members');
      } else {
        $data['member'] = $this->Member_Model->getMembers($slug);

        if(empty($data['member'])) {
          show_404();
        } else {
          $data['title'] = $data['member']['first_name'].' '.$data['member']['last_name'].' | IMS Grid';
          $data['desc'] = $data['member']['short_bio'];

          $this->load->view('templates/header', $data);
          $this->load->view('member/member_view', $data);
          $this->load->view('templates/footer');
        }
      }
    }

    /**
     * Member list
     */
    public function viewAllMembers() {
      $data['members'] = $this->Member_Model->getMembers();
      $data['title'] = 'Members | IMS Grid';
      $data['desc'] = '';

      $this->load->view('templates/header.php', $data);
      $this->load->view('pages/members_view', $data);
      $this->load->view('templates/footer.php');
    }

    /**
     * View member profile page
     * @param string $slug
     */
    public function viewMember($slug = NULL) {
      $data['member'] = $this->Member_Model->getMembers($slug);
      $data['posts'] = $this->Member_Model->getPhotos($slug);
      $data['error'] = '';

      if(empty($data['member'])) {
        show_404();
      } else {
        $data['title'] = $data['member']['first_name'].' '.$data['member']['last_name'].' | IMS Grid';
        $data['desc'] = $data['member']['short_bio'];

        $this->load->view('templates/header', $data);
        $this->load->view('member/member_view', $data);
        $this->load->view('templates/footer');
      }
    }

    public function addMember() {
      $firstName = ucwords(strtolower($this->input->post('fname')));
      $lastName = ucwords(strtolower($this->input->post('lname')));

      if($this->Member_Model->memberAdd($firstName, $lastName)) {
        redirect('admin/users/members');
      } else {
        echo 'failed';
      }
    }

    /**
     * user login
     */
    public function login() {
      $data['title'] = 'Log In | IMS Grid';
      $data['desc'] = '';

      $this->form_validation->set_rules('username', 'Username', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');

      $this->form_validation->set_error_delimiters(
        '
          <div class="form-group row form-err-block">
            <div class="col-md-12">
              <p class="form-err-msg">
                <span class="msg">
        ',
        '
                </span>
              </p>
            </div>
          </div>
        '
      );

      if(!$this->form_validation->run()) {
        $this->session->set_flashdata('loginIsError', true);

        $this->load->view('templates/header', $data);
        $this->load->view('member/login_view');
        $this->load->view('templates/footer');
      } else {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data['member'] = $this->Member_Model->memberLogin($username, $password);

        if(!empty($data['member'])) {
          $userdata = array(
            'firstName' => $data['member']['first_name'],
            'memberId' => $data['member']['id_member'],
            'memberAvatar' => $data['member']['avatar_file_name'],
            'published' => $data['member']['is_published'],
            'loggedIn' => true
          );
          $this->session->set_userdata($userdata);

          redirect('');
        } else {
          $this->session->set_flashdata('loginFailed', 'Username or password is incorrect.');
          $this->session->set_flashdata('logUsername', $this->input->post('username'));

          redirect('login');
        }
      }
    }

    /**
     * logout
     */
    public function logout($memberId) {
      $this->db->set('loggedIn', 0);
      $this->db->where('id_member', $memberId);
      $logout = $this->db->update('member');

      if($logout) {
        $userdata = array(
          'firstName',
          'memberId',
          'memberAvatar',
          'published',
          'loggedIn'
        );
        $this->session->unset_userdata($userdata);

        redirect('');
      }
    }

    /**
     * signup
     */
    public function signup() {
      $data['title'] = 'Create Account | IMS Grid';
      $data['desc'] = '';

      $this->form_validation->set_rules('id-member', 'ID', 'trim|required');
      $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[255]|min_length[4]|is_unique[member.username]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[255]|min_length[8]');
      $this->form_validation->set_rules('password-confirm', 'Confirm Password', 'trim|required|max_length[255]|min_length[8]|matches[password]');
      $this->form_validation->set_rules('security-question', 'Security Question', 'required');
      $this->form_validation->set_rules('security-question-ans', 'Security Question Answer', 'required');
      $this->form_validation->set_rules('shortbio', 'Short Bio', 'required');


      $this->form_validation->set_error_delimiters(
        '
          <div class="form-group row form-err-block">
            <div class="col-md-12">
              <p class="form-err-msg">
                <span class="msg">
        ',
        '
                </span>
              </p>
            </div>
          </div>
        '
      );

      $firstName = $this->input->post('fname');

      if(!$this->form_validation->run()) {
        $this->load->view('templates/header', $data);
        $this->load->view('member/register_view');
        $this->load->view('templates/footer');
      } else {
        if($this->Member_Model->memberSignup()) {
          $this->session->set_flashdata('signupSuccess', 'Your account has been created. Please log in.');

          redirect('login');
        } else {
          $logData = array(
            'signupFailed' => 'The ID was not found.',
            'logId' => $this->input->post('id-member'),
            'logUsername' => $this->input->post('username')
          );
          $this->session->set_flashdata($logData);

          redirect('create');
        }
      }
    }

    public function recover($memberId = null) {
      if($memberId == null) {
        $this->form_validation->set_rules('id', 'ID', 'required');

        if(!$this->form_validation->run()) {
          $data['title'] = 'Recover Account | IMS Grid';
          $data['desc'] = '';

          $this->load->view('templates/header', $data);
          $this->load->view('member/account_recovery_view');
          $this->load->view('templates/footer');
        } else {
          $user = $this->Member_Model->getUser($this->input->post('id'));
          if(!empty($user)) {
            $this->session->set_flashdata('idFound', true);
            $this->session->set_flashdata('memberId', $this->input->post('id'));
            $this->session->set_flashdata('securityQuestion', $user['security_question']);
            redirect('recover/'.$this->input->post('id'));
          } else {
            $this->session->set_flashdata('idNotFound', 'ID was not found.');
            redirect('recover');
          }
        }
      } else {
        $this->form_validation->set_rules('security-question-ans-r', 'Security Question Answer', 'required');

        if(!$this->form_validation->run()) {
          $data['title'] = 'Recover Account | IMS Grid';
          $data['desc'] = '';

          $this->load->view('templates/header', $data);
          $this->load->view('member/account_recover_answer_view');
          $this->load->view('templates/footer');
        } else {
          $newPassword = $this->Member_Model->recoverAccount($memberId, $this->input->post('security-question-ans-r'));
          if($newPassword) {
            $user = $this->Member_Model->getUser($memberId);
           if(!empty($user)) {
              $this->session->set_flashdata('answerSuccess', true);
              $this->session->set_flashdata('newPassword', $newPassword);
              $this->session->set_flashdata('idFound', true);
              $this->session->set_flashdata('successRecovery', true);
              redirect('recover/'.$memberId);
            }
          } else {
            $this->session->set_flashdata('invalidAnswer', 'The answer is incorrect, please try again.');
            $this->session->set_flashdata('idFound', true);
            $this->session->set_flashdata('memberId', $memberId);
            $this->session->set_flashdata('successRecovery', false);
            redirect('recover/'.$memberId);
          }
        }
      }
    }

    public function changePicCov($memberId) {
      if(isset($_POST['cover'])) {
        $this->changeCover($memberId);
      } elseif(isset($_POST['picture'])) {
        $this->changePicture($memberId);
      }
    }

    /**
     * update profile cover
     * @param string $memberId
     */
    public function changeCover($memberId) {
      $data['member'] = $this->Member_Model->getMembers($memberId);
      $data['posts'] = $this->Member_Model->getPhotos($memberId);

      $config = array(
        'upload_path' => './assets/images/uploads/users/covers',
        'encrypt_name' => TRUE,
        'allowed_types' => 'jpg|jpeg',
        'max_size' => '2048',
        'min_width' => '640',
        'min_height' => '640',
        'max_width' => '3000',
        'max_height' => '3000'
      );

      $this->load->library('upload', $config);

      if(!$this->upload->do_upload('cover')) {
        $data['errorCover'] = $this->upload->display_errors('', '');
        $fileNameOld = $data['member']['cover_file_name'];

        if(empty($data['member'])) {
          show_404();
        } else {
          $data['title'] = $data['member']['first_name'].' '.$data['member']['last_name'].' | IMS Grid';
          $data['desc'] = '';

          $this->load->view('templates/header', $data);
          $this->load->view('member/Member_view', $data);
          $this->load->view('templates/footer');
        }
      } else {
        $data['member'] = $this->Member_Model->getMembers($memberId);

        $fileNameOld = $data['member']['cover_file_name'];
        $fileName = $this->upload->data('file_name');

        if($this->Member_Model->uploadCover($fileName, $fileNameOld, $memberId)) {
          $data = array(
            'upload_data' => $this->upload->data()
          );

          redirect('member/'.$memberId);
          $data['errorCover'] = '';

          if(empty($data['member'])) {
            show_404();
          } else {
            $data['title'] = $data['member']['first_name'].' '.$data['member']['last_name'].' | IMS Grid';
            $data['desc'] = $data['member']['short_bio'];

            $this->load->view('templates/header', $data);
            $this->load->view('member/Member_view', $data);
            $this->load->view('templates/footer');
          }
        }
      }
    }

    /**
     * update profile picture
     * @param string $memberId
     */
    public function changePicture($memberId) {
      $data['member'] = $this->Member_Model->getMembers($memberId);
      $data['posts'] = $this->Member_Model->getPhotos($memberId);

      $config = array(
        'upload_path' => './assets/images/uploads/users/avatars',
        'encrypt_name' => TRUE,
        'allowed_types' => 'jpg|jpeg',
        'max_size' => '2048',
        'min_width' => '300',
        'min_height' => '300',
        'max_width' => '3000',
        'max_height' => '3000'
      );

      $this->load->library('upload', $config);

      if(!$this->upload->do_upload('avatar')) {
        $data['errorPicture'] = $this->upload->display_errors('', '');
        $fileNameOld = $data['member']['avatar_file_name'];

        if(empty($data['member'])) {
          show_404();
        } else {
          $data['title'] = $data['member']['first_name'].' '.$data['member']['last_name'].' | IMS Grid';
          $data['desc'] = $data['member']['short_bio'];

          $this->load->view('templates/header', $data);
          $this->load->view('member/Member_view', $data);
          $this->load->view('templates/footer');
        }
      } else {
        $data['member'] = $this->Member_Model->getMembers($memberId);

        $fileNameOld = $data['member']['avatar_file_name'];
        $fileName = $this->upload->data('file_name');

        if($this->Member_Model->uploadPicture($fileName, $fileNameOld, $memberId)) {
          $data = array(
            'upload_data' => $this->upload->data()
          );

          $data['member'] = $this->Member_Model->getMembers($memberId);
          $this->session->set_userdata('memberAvatar', $data['member']['avatar_file_name']);

          redirect('member/'.$memberId);
          $data['errorPicture'] = '';

          if(empty($data['member'])) {
            show_404();
          } else {
            $data['title'] = $data['member']['first_name'].' '.$data['member']['last_name'].' | IMS Grid';
            $data['desc'] = $data['member']['short_bio'];

            $this->load->view('templates/header', $data);
            $this->load->view('member/Member_view', $data);
            $this->load->view('templates/footer');
          }
        }
      }
    }

    /**
     * view profile settings
     * @param string $settings, $slug
     */
    public function settings($settings = NULL, $slug = NULL) {
      $data['member'] = $this->Member_Model->getMembers($slug);
      $data['desc'] = '';

      if(empty($data['member'])) {
        show_404();
      } else {
        if($settings === "profile") {
          $data['title'] = 'Settings • Edit Profile | IMS Grid';

          $this->load->view('templates/header', $data);
          $this->load->view('member/settings/settings_profile_view', $data);
        } elseif($settings === "password") {
          $data['title'] = 'Settings • Change Password | IMS Grid';

          $this->load->view('templates/header', $data);
          $this->load->view('member/settings/settings_password_view', $data);
        } elseif($settings === "networks") {
          $data['title'] = 'Networks • Change Password | IMS Grid';

          $this->load->view('templates/header', $data);
          $this->load->view('member/settings/settings_networks_view', $data);
        } elseif($settings === "delete") {
          $data['title'] = 'Settings • Delete Account | IMS Grid';

          $this->load->view('templates/header', $data);
          $this->load->view('member/settings/settings_delete_view', $data);
        }

        $this->load->view('templates/footer');
      }
    }



    /**
     * update profile information
     * @param string $memberId
     */
    public function updateProfile($memberId) {
      $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[12]|min_length[4]');
      $this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[50]|min_length[1]');
      $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|max_length[50]|min_length[1]');
      $this->form_validation->set_rules('shortbio', 'Short Bio', 'required');

      $this->form_validation->set_error_delimiters(
        '
          <div class="form-group row form-err-block">
            <div class="col-md-12">
              <p class="form-err-msg">
                <span class="msg">
        ',
        '
                </span>
              </p>
            </div>
          </div>
        '
      );

      if(!$this->form_validation->run()) {
        $this->settings('profile', $memberId);
      } else {
        if($this->Member_Model->memberUpdateProfile($memberId)) {
          $this->session->set_flashdata('updateProfileSuccess', 'Changes have been made.');
          
          $userdata = array(
            'firstName' => $this->input->post('fname'),
            'published' => '1'
          );
          $this->session->set_userdata($userdata);
          redirect('settings/profile/'.$memberId);
        } else {
          redirect('settings/profile/'.$memberId);
        }
      }
    }

    /**
     * update profile information
     * @param string $memberId
     */
    public function updatePassword($memberId) {
      $this->form_validation->set_rules('old-password', 'Old Password', 'trim|required|max_length[20]|min_length[8]');
      $this->form_validation->set_rules('new-password', 'New Password', 'trim|required|max_length[20]|min_length[8]');
      $this->form_validation->set_rules('new-password-confirm', 'Confirm New Password', 'trim|required|max_length[20]|min_length[8]|matches[new-password]');

      $this->form_validation->set_error_delimiters(
        '
          <div class="form-group row form-err-block">
            <div class="col-md-12">
              <p class="form-err-msg">
                <span class="msg">
        ',
        '
                </span>
              </p>
            </div>
          </div>
        '
      );

      if(!$this->form_validation->run()) {
        $this->settings('password', $memberId);
      } else {
        if($this->Member_Model->memberUpdatePassword($memberId)) {
          $this->session->set_flashdata('updatePasswordSuccess', 'Password has been updated.');
          redirect('settings/password/'.$memberId);
        } else {
          $this->session->set_flashdata('updatePasswordFailed', 'The password you entered was invalid.');
          redirect('settings/password/'.$memberId);
        }
      }
    }

    public function saveNetwork($memberId) {
      $data = array(
        'n_facebook' => $this->input->post('n-facebook'),
        'n_twitter' => $this->input->post('n-twitter'),
        'n_instagram' => $this->input->post('n-instagram')
      );

      $this->db->where('id_member', $memberId);
      $this->db->update('member', $data);

      redirect('settings/networks/'.$memberId);
    }

    /**
     * delete account (all the posts/photos will also be deleted)
     * @param string $memberId
     */
    public function deleteAccount($memberId) {
      $this->form_validation->set_rules('security-question-ans', 'Security Question Answer', 'required');

      $this->form_validation->set_error_delimiters(
        '
          <div class="form-group row form-err-block">
            <div class="col-md-12">
              <p class="form-err-msg">
                <span class="msg">
        ',
        '
                </span>
              </p>
            </div>
          </div>
        '
      );

      if(!$this->form_validation->run()) {
        $this->settings('delete', $memberId);
      } else {
        if($this->Member_Model->memberDeleteAccount($memberId)) {
            $this->session->unset_userdata('loggedIn');
            redirect('');
        } else {
          $this->session->set_flashdata('deleteAccountFailed', 'The answer was incorrect.');
          redirect('settings/delete/'.$memberId);
        }
      }
    }
  }
?>
