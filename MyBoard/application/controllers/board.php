<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/* 22.05.23 board controller
 * made by 대상추
 * 게시판 메인 컨트롤러 
 * */
class Board extends CI_Controller {
    function __construct() {
        parent::__construct();  // 기본 선언
        $this->load->database();
        $this->load->model('board_m');
        $this->load->helper(array('url', 'date'));
    }

    /* 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드 */
    public function index() {
        $this->lists();
    }

    /* 사이트 헤더, 푸터 자동 추가 */
    // public function _remap($method) {
    //     // 헤더 include
    //     $this->load->view('header_v');
    //     if(method_exists($this, $method)) {
    //         $this->{"{$method}"}();
    //     }
    //     // 푸터 include
    //     $this->load->view('footer_v');
    // }

    /* 목록 불러오기 */
    public function lists() {
        // $data['list'] = $this->board_m->get_list();  // 생성자에서 모델을 로드하지 않고 모델 내 함수를 호출하면 에러가 발생한다.
        // $this->load->view('board/list_v', $data);    // 뷰 역시 마찬가지이다. 즉, 생성자에서 라이브러리나 모델 등 웬만한 것은 로딩하고 함수호출하는 것이 좋다.

        //+++++++++++++++++++++++++++++++++++++++++++//
        // 검색어 초기화
        $this->output->enable_profiler(TRUE);
        $search_word = $page_url = '';
        $uri_segment = 5;

        // 주소 중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 반환
        $uri_array = $this->segment_explode($this->uri->uri_string());

        if (in_array('q', $uri_array)) {
            // 주소에 검색어가 있을 경우 처리
            $search_word = urldecode($this->url_explode($uri_array,'q'));
            // 페이지네이션용 주소
            $page_url = '/q/' .$search_word;
            $uri_segment = 7;
        }

        //+++++++++++++++++++++++++++++++++++++++++++//
        // 페이지네이션 설정
        $this->load->library('pagination'); // pagination을 이용하기 위해 라이브러리를 로딩한다.
        // 페이징 주소
        $config['base_url'] = '/MyBoard/index.php/board/lists/ci_board' . $page_url .'/page/';
        // 게시물 전체 개수
        $config['total_rows'] = $this->board_m->get_list($this->uri->segment(3), 'count', '', '', $search_word);
        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 5;
        // 페이지 번호가 위치한 세그먼트
        $config['uri_segment'] = $uri_segment;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);
        // 페이지 링크를 생성하여 view에서 사용하는 변수에 할당
        $data['pagination'] = $this->pagination->create_links();    // 보여줄 페이지네이션이 없을 경우 create_links()함수는 빈 문자열을 리턴한다.

        // 게시물 목록을 불러오기 위한 offset, limit 값 가져오기
        $data['page'] = $page = $this -> uri -> segment($uri_segment, 1);

        if ($page > 1) {
            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];
        $data['list'] = $this->board_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
        $this->load->view('board/list_v', $data);
        
    }

    /* url 중 key 값을 구분하여 값을 가져오도록한다. 
     * 
     * @param Array $uri : segment_explode 한 url값
     * @param String $key : 가져오려는 값의 key
     * @trturn String $url[$k] : 리턴 값
     *
     * */
    function url_explode($url, $key) {
        $cnt = count($url);

        for($i = 0; $cnt > $i; $i++) {
            if ($url[$i] == $key) {
                $k = $i + 1;
                return $url[$k];
            }
        }
    }
    
    /* HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꿔 리턴한다. 
     * 
     * @param String 대상이 되는 문자열
     * @return string[]
     * */
    function segment_explode($seg) {
        /* 세그먼트 앞 뒤 "/" 제거 후 uri를 배열로 반환
         * 주소에서 '/'로 구분된 내용을 ci에서 세그먼트라 부른다.
         * ci 주소 규칙에 index.php는 0번째 세그먼트이다.($this->uri->segment(0))
         * 첫 번째 세그먼트 = main
         * 두 번째 세그먼트 = view
         * 세 번째 세그먼트 = 1  // 그래서 $id 변수에 1이 들어가기 위해 세그먼트는(3)으로 되는것이다.
         */
        
        // 세그먼트 앞, 뒤 '/'제거 후 uri를 배열로 반환
         $len = strlen($seg);
        if (substr($seg, 0, 1) == '/') {
            $seg = substr($seg, 1, $len);
        }
        
        $len = strlen($seg);

        if (substr($seg, -1) == '/') {
            $seg = substr($seg, 0, $len - 1);
        }

        $seg_exp = explode("/", $seg);
        return $seg_exp;
    }

    /* 게시물 보기 */
    function view() {
        // 게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
        $data['views'] = $this->board_m->get_view($this->uri->segment(3), $this->uri->segment(4));
        
        // view 호출
        $this->load->view('board/view_v', $data);
    }

    /* 게시물 작성 */
    function write() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
        
        if($_POST) {
            // 글 작성 post 전송 시, 경고창 헬퍼 로딩
            $this->load->helper('alert');

            // 주소 중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 반환
            $uri_array = $this->segment_explode($this->uri->uri_string());

            if (in_array('page', $uri_array)) {
                $pages = urldecode($this->url_explode($uri_array, 'page'));
            } else {
                $pages = 1;
            }

            if (!$this->input->post('subject', TRUE) AND !$this->input->post('contents', TRUE)) {
                // 글 내용이 없을 경우, 프로그램 단에서 한 번 더 체크
                alert('비정상적인 접근입니다.', '/MyBoard/index.php/board/lists/'.$this->uri->segment(3) .'/page/' .$pages);
                exit;
            }
            
            // var_dump($_post);
            $write_data = array(
                'subject' =>$this->input->post('subject', TRUE),
                'contents' =>$this->input->post('contents', TRUE),
                'table' => $this->uri->segment(3)
            );

            $result = $this->board_m->insert_board($write_data);

            if ($result) {
                alert("입력되었습니다.", '/MyBoard/index.php/board/lists/' .$this->uri->segment(3) .'/page/' .$pages);
                exit;
            } else {
                alert("다시 입력해주세요.", '/MyBoard/index.php/board/lists/' .$this->uri->segment(3) .'/page/' .$pages);
                exit;
            }
        } else {
            // 작성 폼 view 호출
            $this->load->view('board/write_v');
        }
    }

    /* 게시물 수정 */
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';

        if ($_POST) { // 글 수정 POST 전송 시
            $this->load->helper('alert');   // 경고창 헬퍼 로딩
            // 주소 중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
            $uri_array = $this->segment_explode($this->uri->uri_string());

            if (in_array('page', $uri_array)) {
                $pages = urldecode($this->url_explode($uri_array, 'page'));
            } else {
                $pages = 1;
            }

            // 글 내용이 없다면, 프로그램단에서 한 번 더 체크
            if (!$this->input->post('subject', TRUE) AND !$this->input->post('contents', TRUE)) {
                alert('비정상적인 접근입니다.', 'Myboard/index.php/board/lists/' .$this->uri->segment(3) .'/page/' .$pages);
                exit;
            }

            // var_dump($_POST);
            $modify_data = array(
                'table' => $this->uri->segment(3), // 게시판 테이블명
                'board_id' => $this->uri->segment(5), // 게시물 번호
                'subject' => $this->input->post('subject', TRUE),
                'contents' => $this->input->post('contents', TRUE),
            );

            $result = $this->board_m->modify_board($modify_data);

            if ($result) { // 글 작성 성공시 게시물 목록으로
                alert('수정되었습니다.', 'Myboard/index.php/board/lists/' .$this->uri->segment(3) .'/page/' .$pages);
                exit;
            } else { // 글 작성 실패시 글 내용으로 
                alert('다시 수정해주세요.', 'Myboard/index.php/board/view/' .$this->uri->semgent(3) .'/board_id/' .$this->uri->segment(5) .'/page/' .$pages);
                exit;
            } 
        }else { // 게시물 내용 가져오기
            $data['views'] = $this->board_m->get_view($this->uri->segment(3), $this->uri->segment(5));
            // 쓰기 폼 view 호출
            $this->load->view('board/modify_v', $data);
        }
    }

    /* 게시물 삭제 */
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        // 경고창 헬퍼 로딩
        $this->load->helper('alert');
        // 게시물 번호에 해당하는 게시물 삭제
        $return = $this->board_m->delete_content($this->uri->segment(3), $this->uri->segment(5));
        // 게시물 목록으로 돌아가기
        if ($return) {  // 삭제 성공한 경우
            alert('삭제되었습니다.', 'myboard/index.php/board/lists/' .$this->uri->segment(3) .'/page/' .$this->rui->segment(7));
        } else {    // 삭제 실패한 경우
            alert('삭제 실패', '/myboard/index.php/board/view/' .$this->uri->segment(3) .'/board_id/' .$this->uri->segment(5) .'/page/' .$this->rui->segment(7));
        }
    }
}

?>