<?php
class HomePageController extends MY_Controller
{

    public function index()
    {
        $data = [];
        $this->renders('index', $data);
    }
}
