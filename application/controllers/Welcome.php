<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_controller
{
	public function index()
	{
		redirect('home');
	}
}
