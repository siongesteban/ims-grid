<?php
  class Home extends CI_Controller {
    function __construct() {
      parent::__construct();
      $data['desc'] = '';
    }

    public function index() {
      $data['posts'] = $this->Photo_Model->getPosts();
      $this->db->order_by('name', 'ASC');
      $categories = $this->db->get('category');
      $data['categories'] = $categories->result_array();
      $data['members'] = $this->Member_Model->getMembers();
      $data['title'] = 'Home | IMS Grid';
      $data['desc'] = '';

      $this->load->view('templates/header.php', $data);
      $this->load->view('pages/home_view', $data);
      $this->load->view('templates/footer.php');
    }

    public function grid() {
      $data['posts'] = $this->Photo_Model->getPosts();
      $data['title'] = 'Grid | IMS Grid';
      $data['desc'] = '';

      $this->load->view('templates/header.php', $data);
      $this->load->view('pages/grid_view', $data);
      $this->load->view('templates/footer.php');
    }

    public function categories($slug = NULL) {
      if($slug == NULL) {
        $this->db->order_by('name', 'ASC');
        $categories = $this->db->get('category');
        $data['categories'] = $categories->result_array();

        $data['title'] = 'Categories | IMS Grid';
        $data['desc'] = '';

        $this->load->view('templates/header.php', $data);
        $this->load->view('pages/categories_view');
        $this->load->view('templates/footer.php');
      } else {
        $this->db->where('slug', $slug);
        $categories = $this->db->get('category');
        $data['title'] = $categories->row(0)->name.' | IMS Grid';
        $data['desc'] = '';
        $data['posts'] = $this->Photo_Model->getPostsCategorized($slug);

        $this->load->view('templates/header.php', $data);
        $this->load->view('photo/categorized_photo_view', $data);
        $this->load->view('templates/footer.php');
      }
    }
  }
?>
