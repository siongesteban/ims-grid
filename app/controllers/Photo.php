<?php
  class Photo extends CI_Controller {
    function __construct() {
      parent::__construct();

      $data['desc'] = '';
    }

    public function index() {
      $data['posts'] = $this->Photo_Model->getPosts();
      $data['title'] = 'Home | IMS Grid';
      $data['desc'] = '';

      $this->load->view('templates/header.php', $data);
      $this->load->view('pages/home_view', $data);
      $this->load->view('templates/footer.php');
    }

    public function viewPhoto($slug = NULL) {
      $data['post'] = $this->Photo_Model->getPosts($slug);

      if(empty($data['post'])) {
        show_404();
      } else {
        $data['title'] = $data['post']['title'].' by '.$data['post']['member_first_name'].' '.$data['post']['member_last_name'].' | IMS Grid';
        $data['desc'] = $data['post']['story'];
        $data['memberPosts'] = $this->Photo_Model->getMemberPosts($data['post']['id_member']);

        $this->load->view('templates/header', $data);
        $this->load->view('photo/photo_view', $data);
        $this->load->view('templates/footer');
      }      
    }

    public function upload() {
      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('story', 'Description', 'required');

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
        $data['title'] = 'Upload | IMS Grid';
        $data['desc'] = '';
        $this->db->order_by('name', 'ASC');
        $data['categories'] = $this->db->get('category')->result_array();
        $data['error'] = '';

        $this->load->view('templates/header', $data);
        $this->load->view('photo/upload_view', $data);
        $this->load->view('templates/footer');
      } else {
        $config = array(
          'upload_path' => './assets/images/uploads/photos',
          'encrypt_name' => TRUE,
          'allowed_types' => 'jpg|jpeg',
          'max_size' => '5120',
          'min_width' => '1000',
          'min_height' => '1000',
          'max_height' => '3000',
          'max_width' => '3000'
        );

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('userfile')) {
          $error = array(
            'error' => $this->upload->display_errors()
          );

          $data['title'] = 'Upload | IMS Grid';
          $data['desc'] = '';
          $this->db->order_by('name', 'ASC');
          $data['categories'] = $this->db->get('category')->result_array();

          $this->load->view('templates/header', $data);
          $this->load->view('photo/upload_view', $error);
          $this->load->view('templates/footer');
        } else {
          $fileName = $this->upload->data('file_name');
          if($this->Photo_Model->publishPost($fileName)) {
            $data = array(
              'upload_data' => $this->upload->data()
            );
            $this->session->set_flashdata('uploadSuccess', 'Your post will be displayed immediately to the grid after approval.');
            redirect('');
          } else {
            echo $this->session->flashdata('watermarkFailed');
          }
        }
      }
    }

    public function delete($id, $fileName, $user = null) {
      if($this->Photo_Model->deletePost($id, $fileName)) {
        if($user == null)
          redirect('');
        else
          if($user == 'adminn')
            redirect('admin/posts/published');
          else
            redirect('admin/posts/approvals');
      }
    }

    public function edit($slug = NULL) {
      $data['post'] = $this->Photo_Model->getPosts($slug);

      if(empty($data['post'])) {
        show_404();
      } else {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('story', 'Description', 'required');

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
          $data['title'] = 'Edit | IMS Grid';
          $data['desc'] = '';
          $this->db->order_by('name', 'ASC');
          $data['categories'] = $this->db->get('category')->result_array();

          $this->load->view('templates/header', $data);
          $this->load->view('photo/photo_edit_view', $data);
          $this->load->view('templates/footer');
        } else {
          if($this->Photo_Model->editPost()) {
            redirect('photo/'.$slug);
          } else {
            $this->session->set_flashdata('editFailed', 'Failed');
            echo 'failed';
          }
        }
      }      
    }
  }
?>
