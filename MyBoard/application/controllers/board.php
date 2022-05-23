<!-- 
    22.05.23 board controller
    made by 대상추
 -->
<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/* 게시판 메인 컨트롤러 */
class Board extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('board_m');
        $this->load->helper(array('url', 'date'));
    }

    /* 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드 */
    public function index() {
        $this->lists();
    }

    /* 사이트 헤더, 푸터 자동 추가 */
    public function _remap($method) {
        // 헤더 include
        $this->load->view('header_v');
        if(method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
        // 푸터 include
        $this->load->view('footer_v');
    }

    /* 목록 불러오기 */
    public function lists() {
        // $data['list'] = $this->board_m->get_list();
        // $this->load->view('board/list_v', $data);

        //+++++++++++++++++++++++++++++++++++++++++++//

        // 페이지네이션 설정
        $this->load->library('pagination'); // pagination을 이용하기 위해 라이브러리를 로딩한다.
        // 페이징 주소
        $config['base_url'] = '/MyBoard/index.php/board/lists/ci_board/page';
        // 게시물 전체 개수
        $config['total_rows'] = $this->board_m->get_list($this->uri->segment(3), 'count');
        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 5;
        // 페이지 번호가 위치한 세그먼트
        $config['uri_segment'] = 5;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);
        // 페이지 링크를 생성하여 view에서 사용하는 변수에 할당
        $data['pagination'] = $this->pagination->create_links();

        // 게시물 목록을 불러오기 위한 offset, limit 값 가져오기
        $page = $this -> uri -> segment(5, 1);

        if ($page > 1) {
            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];
        $data['list'] = $this->board_m->get_list($this->uri->segment(3), '', $start, $limit);
        $this->load->view('board/list_v', $data);
        
    }

}

?>