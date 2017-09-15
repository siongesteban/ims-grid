<?php
	class Photo_Model extends CI_Model {
		public function getPosts($slug = FALSE) {
			if(!$slug) {
				$this->db->where('is_published', 1);
				$this->db->order_by('upload_date_time', 'DESC');
				$posts = $this->db->get('photo');

				if($posts) {
					return $posts->result_array();
				}
			} else {
				$post = $this->db->get_where('photo', array('id_photo' => $slug, 'is_published' => 1));

				if($post) {
					return $post->row_array();
				}
			}
		}

		public function getMemberPosts($memberId) {
			$memberPosts = $this->db->get_where('photo', array('id_member' => $memberId));

			return $memberPosts->result_array();
		}

		public function getUnpublishedPosts() {
			$this->db->where('is_published', 0);
			$this->db->order_by('upload_date_time', 'DESC');
			$posts = $this->db->get('photo');

			if($posts) {
				return $posts->result_array();
			}
		}

		public function getPostsCategorized($categorySlug) {
			$this->db->where('category_slug', $categorySlug);
			$this->db->where('is_published', 1);
			$this->db->order_by('upload_date_time', 'DESC');
			$photos = $this->db->get('photo');

			if($photos) {
				return $photos->result_array();
			}
		}

		

		public function publishPost($fileName) {
			$memberId = $this->input->post('id');
			$this->db->where('id_member', $memberId);
			$member = $this->db->get('member');

			if($member->num_rows() > 0) {
				$memberId = $member->row(0)->id_member;
				$memberFirstName = $member->row(0)->first_name;
				$memberLastName = $member->row(0)->last_name;

				$data = array(
					'id_photo' => random_string('numeric', 6),
					'id_member' => $memberId,
					'member_first_name' => $memberFirstName,
					'member_last_name' => $memberLastName,
					'file_name' => $fileName,
					'title' => $this->input->post('title'),
					'story' => $this->input->post('story'),
					'category' => $this->input->post('category'),
					'category_slug' => url_title(strtolower($this->input->post('category')), 'dash'),
					'camera' => $this->input->post('camera'),
					'aperture' => $this->input->post('aperture'),
					'shutter_speed' => $this->input->post('shutter-speed'),
					'iso' => $this->input->post('iso')
				);

				copy('./assets/images/uploads/photos/'.$fileName, './assets/images/uploads/photos/thumbnails/thumb_'.$fileName);

				$this->createThumbnail($fileName);
				$this->watermarkPhoto($fileName);
				$this->resizePhoto($fileName);

				ImageJPEG(ImageCreateFromString(file_get_contents('./assets/images/uploads/photos/'.$fileName)), './assets/images/uploads/photos/'.$fileName, 90);
				ImageJPEG(ImageCreateFromString(file_get_contents('./assets/images/uploads/photos/thumbnails/thumb_'.$fileName)), './assets/images/uploads/photos/thumbnails/thumb_'.$fileName, 90);

				$query = $this->db->insert('photo', $data);

				if($query) {
					return true;
				} else {
					return false;
				}
			}
		}

		public function editPost() {
			$data = array(
				'id_photo' => $this->input->post('id-photo'),
				'title' => $this->input->post('title'),
				'story' => $this->input->post('story'),
				'category' => $this->input->post('category'),
				'category_slug' => url_title(strtolower($this->input->post('category')), 'dash'),
				'camera' => $this->input->post('camera'),
				'aperture' => $this->input->post('aperture'),
				'shutter_speed' => $this->input->post('shutter-speed'),
				'iso' => $this->input->post('iso')
			);

			$this->db->where('id_photo', $data['id_photo']);

			if($this->db->update('photo', $data)) {
				if($this->db->affected_rows() > 0) {
          return true;
        } else {
          return true;
        }
			}
		}

		public function deletePost($id, $fileName) {
			$this->db->where('id_photo', $id);
			$query = $this->db->delete('photo');

			if($query) {
				unlink('./assets/images/uploads/photos/'.$fileName);
				unlink('./assets/images/uploads/photos/thumbnails/thumb_'.$fileName);
				return true;
			} else {
				return false;
			}
		}

		public function watermarkPhoto($fileName) {
			$config['source_image'] = './assets/images/uploads/photos/'.$fileName;
			$config['wm_text'] = 'INTERACTIVE MEDIA SOCIETY';
			$config['wm_type'] = 'text';
			$config['wm_font_path'] = './assets/fonts/Raleway/Raleway-Black.ttf';
			$config['wm_font_size'] = '17';
			$config['wm_font_color'] = 'ffffff';
			$config['wm_vrt_alignment'] = 'top';
			$config['wm_hor_alignment'] = 'right';
			$config['wm_hor_offset'] = '-50';
			$config['wm_padding'] = '20';

			$this->image_lib->initialize($config);

      if($this->image_lib->watermark()) {
        return true;
      } else {
        return false;
      }
		}

		public function createThumbnail($fileName) {
			$config = array(
				'source_image' => 'photos/'.$fileName,
				'new_image' => 'photos/thumbnails/thumb_'.$fileName,
				'width' => 480,
				'height' => 480,
				'maintain_ratio' => FALSE
			);

			$this->load->library('image_lib');

			if($this->image_lib->thumb($config, FCPATH . 'assets/images/uploads/')) {
				return true;
			} else {
				return false;
			}
		}

		public function resizePhoto($fileName) {
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/images/uploads/photos/'.$fileName;
			$config['maintain_ratio'] = TRUE;
			$config['width']         = 1080;
			$config['height']       = 1080;

			$this->image_lib->initialize($config);

			$this->image_lib->resize();
		}
	}
?>