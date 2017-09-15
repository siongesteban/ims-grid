<?php
  /**
   * Member model
   * @author Jerico Esteban
   */
  class Member_Model extends CI_Model {
    /**
     * Fetch members
     * @param string $slug
     */
    public function getMembers($slug = FALSE) {
      if(!$slug) {
        $this->db->order_by('first_name', 'ASC');
        $members = $this->db->get('member');

        if($members) {
          return $members->result_array();
        }
      } else {
        $post = $this->db->get_where(
          'member',
          array(
            'id_member' => $slug
          )
        );

        if($post) {
          return $post->row_array();
        }
      }
    }

    /**
     * Fetch all photos
     * @param string $slug
     */
    public function getPhotos($slug = FALSE) {
      $this->db->order_by('upload_date_time', 'DESC');
      $post = $this->db->get_where('photo', array('id_member' => $slug, 'is_published' => 1));

      if($post) {
        return $post->result_array();
      }
    }

    public function memberAdd($firstName, $lastName) {
      $data = array(
        'id_member' => random_string('numeric', 6),
        'first_name' => $firstName,
        'last_name' => $lastName
      );

      return $this->db->insert('member', $data);
    }

    /**
     * signup member
     */
    public function memberSignup() {
      $memberId = $this->input->post('id-member');
      $data = array(
        'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
        'password' => md5($this->input->post('password')),
        'short_bio' => $this->input->post('shortbio'),
        'security_question' => $this->input->post('security-question'),
        'security_question_ans' => $this->input->post('security-question-ans'),
        'is_registered' => '1',
        'is_published' => '1'
      );

      $this->db->where('id_member', $memberId);
      $this->db->where('is_registered', 0);

      if($this->db->update('member', $data)) {
        if($this->db->affected_rows() > 0) {
          return true;
        } else {
          return false;
        }
      }
    }

    /**
     * login member
     * @param string $username, $password
     */
    public function memberLogin($username, $password) {
      $this->db->where('username', $username);
      $this->db->where('password', md5($password));

      $member = $this->db->get('member');
      
      if($member) {
        $this->db->set('loggedIn', 1);
        $this->db->where('username', $username);

        if($this->db->update('member')) {
          return $member->row_array();
        } else {
          return false;
        }
      }
    }

    public function getUser($memberId) {
      $data = array('id_member' => $memberId);

      $this->db->where('id_member', $memberId);
      $this->db->where('is_registered', 1);
      $user = $this->db->get('member');

      if($user->num_rows() == 1) {
        return $user->row_array();
      } else {
        return false;
      }
    }

    /**
     * update profile cover
     * @param string $fileName, $fileNameOld, $memberId
     */
    public function uploadCover($fileName, $fileNameOld, $memberId) {
      $data = array(
        'cover_file_name' => $fileName
      );

      $this->db->where('id_member', $memberId);

      if($this->db->update('member', $data)) {
        if($this->db->affected_rows() > 0) {
          ImageJPEG(ImageCreateFromString(file_get_contents('./assets/images/uploads/users/covers/'.$fileName)), './assets/images/uploads/users/covers/'.$fileName, 90);

          if($fileNameOld != 'cover_default.jpg') {
            unlink('./assets/images/uploads/users/covers/'.$fileNameOld);
          }

          return true;
        } else {
          return false;
        }
      }
    }

    public function recoverAccount($memberId, $securityQuestionAnswer) {
      $newPassword = random_string('alnum', 16);

      $data = array(
        'password' => md5($newPassword)
      );

      $this->db->where('id_member', $memberId);
      $this->db->where('security_question_ans', $securityQuestionAnswer);
      if($this->db->update('member', $data)) {
        if($this->db->affected_rows() == 1) {
          return $newPassword;
        } else {
          return false;
        }
      }
    }

    /**
     * update profile picture
     * @param string $fileName, $fileNameOld, $memberId
     */
    public function uploadPicture($fileName, $fileNameOld, $memberId) {
      $data = array(
        'avatar_file_name' => $fileName
      );

      $this->db->where('id_member', $memberId);

      if($this->db->update('member', $data)) {
        if($this->db->affected_rows() > 0) {
          ImageJPEG(ImageCreateFromString(file_get_contents('./assets/images/uploads/users/avatars/'.$fileName)), './assets/images/uploads/users/avatars/'.$fileName, 90);

          $this->createPicture($fileName);

          if($fileNameOld != 'avatar_default.jpg') {
            unlink('./assets/images/uploads/users/avatars/'.$fileNameOld);
          }

          return true;
        } else {
          return false;
        }
      }
    }

    public function createPicture($fileName) {
      $config = array(
        'source_image' => 'users/avatars/'.$fileName,
        'new_image' => 'users/avatars/'.$fileName,
        'width' => 640,
        'height' => 640,
        'maintain_ratio' => FALSE
      );

      $this->load->library('image_lib');

      if($this->image_lib->thumb($config, FCPATH . 'assets/images/uploads/')) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * update member information
     * @param string $memberId
     */
    public function memberUpdateProfile($memberId) {
      $this->db->where('id_member', $memberId);

      $data = array(
        'first_name' => ucwords(strtolower($this->input->post('fname'))),
        'last_name' => ucwords(strtolower($this->input->post('lname'))),
        'username' => $this->input->post('username'),
        'short_bio' => $this->input->post('shortbio'),
        'is_published' => 1
      );

      if($this->db->update('member', $data)) {
        if($this->db->affected_rows() > 0) {
          $this->db->where('id_member', $memberId);

          $postEdit = array(
            'member_last_name' => $data['last_name'],
            'member_first_name' => $data['first_name']
          );

          $this->db->update('photo', $postEdit);

          return true;
        } else {
          return true;
        }
      }
    }

    /**
     * update member password
     * @param string $memberId
     */
    public function memberUpdatePassword($memberId) {
      $oldPassword = $this->input->post('old-password');
      $newPassword = $this->input->post('new-password');

      $data = array(
        'password' => md5($newPassword)
      );

      $this->db->where('id_member', $memberId);
      $this->db->where('password', md5($oldPassword));
      
      if($this->db->update('member', $data)) {
        if($this->db->affected_rows() > 0) {
          return true;
        } else {
          return false;
        }
      }
    }

    /**
     * delete account and photos
     * @param string $memberId
     */
    public function memberDeleteAccount($memberId) {
      $this->db->where('id_member', $memberId);
      $photo = $this->db->get('photo');

      $rowNum = 0;
      $fileNames = array();

      foreach($photo->result() as $row) {
        $fileNames[$rowNum] = $row->file_name;
        $rowNum++;
      }

      $securityQuestionAnswer = $this->input->post('security-question-ans');
      $this->db->where('id_member', $memberId);
      $this->db->where('security_question_ans', $securityQuestionAnswer);
      $this->db->delete('member');
      if($this->db->affected_rows() > 0) {
        $this->db->where('id_member', $memberId);
        if($this->db->delete('photo')) {
          foreach($fileNames as $row) {
            unlink('./assets/images/uploads/photos/'.$row);
            unlink('./assets/images/uploads/photos/thumbnails/thumb_'.$row);
          }
          return true;
        } else {
          return true;
        }
      } else {
        return false;
      }
    }
  }
?>
