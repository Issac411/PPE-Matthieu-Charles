<?php
$path = KERNEL.'/controller.php';
require_once("$path");

class controllermembre extends controller
{
    public function __construct() {
        $this->models=array('membre','message');
        parent::__construct();
    }

    function read($id)
    {
        $data = array('membre'=>$this->membre->read($id));
        $this->set($data);
        $this->render('read');
    }

    function readAll() {
        $data = array('membre'=>$this->membre->readAll());
        $this->set($data);
        $this->render('read');
    }

    function set_avatar() {
        $id = $_POST['id'];
        $avatar = $_POST['avatar'];
        $membre = new membre();
        $membre->set_id($id);
        $membre->set_avatar($avatar);
        $membre->change_avatar();
        $path = "location:".WEBROOT."/membre/read/".$id;
        header($path);
    }

    function checker_create($id) {
        $membre = new membre();
        $membre->set_id($id);
        $data = $membre->check_create_right();
        return $data;
    }




}
