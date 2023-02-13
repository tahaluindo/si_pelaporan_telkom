<?php
class AboutPageController extends MY_Controller
{

    public function index()
    {
        $data = [];
        $this->renders('about', $data);
    }
}
