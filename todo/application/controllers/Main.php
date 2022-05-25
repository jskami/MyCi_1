<!-- 
    컨트롤러는 일반적으로 모델과 뷰 사이에서 동작하며, 비즈니스 로직을 처리한다.
 -->
<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    /* todo 컨트롤러 */
class Main extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('todo_m');
        $this->load->helper(array('url', 'date'));
    }

    public function index() {
        $this->lists();
    }

    /* todo 목록 */
    public function lists() {
        $data['list'] = $this->todo_m->get_list();
        $this->load->view('todo/list_v', $data);
    }

    /* todo 조회 */
    public function view() {
        // todo 번호에 해당하는 데이터 가져오기
        $id = $this->uri->segment(3);   // 참고 : https://extbrain.tistory.com/111
        $data['views'] = $this->todo_m->get_view($id);

        // view 호출
        $this->load->view('todo/view_v', $data);
    }

    /* todo 쓰기 */
    public function write() {
        if($_POST) {
            // 글쓰기 post 전송 시
            $content = $this->input->post('content', TRUE); // $_POST['content']와 동일하게 post변수를 받아주는 역할이다. post함수의 두 번째 파라미터에 TRUE를 주면 XSS 공격을 막을 수 있게 자동 처리한다.(무조건 사용할 것)
            $created_on = $this->input->post('created_on', TRUE);
            $due_date = $this->input->post('due_date', TRUE);

            $this->todo_m->insert_todo($content, $created_on, $due_date);   // post전송받은 데이터를 insert_todo함수에 전달하여 DB에 입력한다.

            redirect('/main/lists/');

            exit;
        } else {
            // 쓰기 폼 view 호출
            $this->load->view('todo/write_v');
        }
    }

    /* todo 삭제 */
    public function delete() {
        // 게시물 번호에 해당하는 게시물 삭제
        $id = $this->uri->segment(3);
        $this->todo_m->delete_todo($id);

        redirect('/main/lists/');
    }

}
/* End of file main.php */
/* Location: ./application/controllers/main.php */

?>
