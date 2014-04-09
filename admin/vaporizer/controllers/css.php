<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Css extends CI_Controller {

	public function a($css)
	{
		$this->load->view('css/'.$css);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */