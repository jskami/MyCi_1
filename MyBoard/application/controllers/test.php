<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

/* 기타 테스트용 컨트롤러 */
class Test extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    // 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
    public function index() {
        $this->forms();
    }

    public function _remap($method) {
        $this->load->view('header_v');

        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
        $this->load->view('footer_v');
    }

    /* 폼 검증 테스트 */
    public function forms() {
        $this->output->enable_profiler(TRUE);

        // Form validation 라이브러리 로드
        $this->load->library('form_validation');

        // 폼 검증 필드와 규칙 사전 정의
        // $this->form_validation->set_rules('username', '아이디', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('username', '아이디', 'callback_username_check'); // 15-2. 콜백함수를 위한 수정
        $this->form_validation->set_rules('password', '비밀번호', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', '비밀번호 확인', 'required');
        $this->form_validation->set_rules('email', '이메일', 'required|valid_email');

        $this->form_validation->set_rules('count', '기본 값', 'numeric');
        $this->form_validation->set_rules('myselect', '셀렉트 값', '');
        $this->form_validation->set_rules('mycheck[]', '체크박스', '');
        $this->form_validation->set_rules('myradio', '라디오 버튼', '');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('test/forms_v');  // 폼 검증이 실패할 경우 일반 입력 페이지
        } else {
            $this->load->view('test/form_success_v');   // 폼 검증이 성공할 경우 성공 페이지 
        }
    }

    // 15-2. 콜백함수를 위한 메서드
    public function username_check($id) {
        $this->load->database();

        if($id) {
            $result = array();
            $sql = "SELECT * FROM users WHERE username = '".$id."'";
            $query = $this->db->query($sql);
            $result = @$query->row();

            if ($result) {
                $this->form_validation->set_message('username_check', $id.'은(는) 중복된 아이디입니다.');
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }



}

