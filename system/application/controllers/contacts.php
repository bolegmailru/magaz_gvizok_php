<?php

/**
 */
class Contacts extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Contacts()
    {
        parent::Controller();
        $this->load->helper(array('form', 'url'));
        $this->load->model('admin/common_model', 'common_dao');
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->library('session');
    }

    function index()
    {
        $form_act = $this->input->post('form_act');
        if($form_act)
        {# проверка формы
            $this->load->library('email');
            $config['protocol'] = 'mail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from('admin@quadrat.hajdu.ru', 'Посетитель сайта quadrat');
            $this->email->to('b.oleg@mail.ru,dolbeshkin@yandex.ru');
            #$this->email->cc('another@another-example.com');
            #$this->email->bcc('them@their-example.com');

            $this->email->subject('Письмо с сайта quadrat.ru');
            $this->email->message("Имя: ".$this->input->post('fio')."\n\rEMAIL: ".$this->input->post('email')."\n\rТекст: ".$this->input->post('text'));

            $this->email->send();
        }

        $item = $this->common_dao->get_one_text(6);
        $html_form = $this->load->view('contact_form', array(), TRUE);
        $data = array(
            'text' => $item[0],
            'container' => 'text',
            'text2' => $html_form
        );

        $this->load->view('other', $data);
    }




}



?>