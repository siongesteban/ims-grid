<?php
	class Admin_Model extends CI_Model {
		public function adminLogin($username, $password) {
			$user = array(
				'username' => $username,
				'password' => md5($password)
			);

			$userLogin = $this->db->get_where('admin', $user);

			if($userLogin) {
				return $userLogin->row_array();
			} else {
				return false;
			}
		}

		public function memberDeleteAccount($memberId) {
      $this->db->where('id_member', $memberId);
      $photo = $this->db->get('photo');

      $rowNum = 0;
      $fileNames = array();

      foreach($photo->result() as $row) {
        $fileNames[$rowNum] = $row->file_name;
        $rowNum++;
      }

      $this->db->where('id_member', $memberId);
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