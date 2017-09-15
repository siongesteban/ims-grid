<?php
  class User extends CI_Controller {
    public function userLogin() {

    }

    public function userRegister() {
    }

    public function userConfirm() {
      $this->form_validation->set_rules('confirmation_code', 'Confirmation Code', 'trim|required|max_length[5]|min_length[5]');

      if($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('confirmed_failed', 'The code entered was invalid.');
        $this->load->view('templates/header_nonav');
        $this->load->view('member/confirm_view');
        $this->load->view('templates/footer_nofoot');
      }
    }
  }
?>
