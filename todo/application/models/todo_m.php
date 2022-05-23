<!-- 
    모델은 데이터 구조를 표현한다.
    일반적으로 모델 클래스는 데이터를 추출, 입력, 갱신하는 등의 함수를 포함한다.
    모델 없이도 작동 될 만큼 느슨한 MVC구조를 가진 것이 CI다.
-->
<?php
    /* todo 모델 */
class Todo_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_list() {
        $sql = "SELECT * FROM items";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /* todo 조회 */
    function get_view($id) {
        $sql = "SELECT * FROM items WHERE id='" . $id . "'";
        $query = $this -> db -> query($sql);
        $result = $query->row();
        return $result;
    }
    
    /* todo 쓰기 */
    function insert_todo($content, $created_on, $due_date) {
        $sql = "INSERT INTO items (content, created_on, due_date) VALUES ('" . $content ."','" . $created_on . "','" . $due_date ."')";
        $query = $this->db->query($sql);
    }   // 반환 없이 데이터 입력 후 완료

    /* todo 삭제 */
    function delete_todo($id) {
        $sql = "DELETE FROM items WHERE id = '".$id."'";
        $this->db->query($sql);
    }


}
/* End of file todo_m.php */
/* Location: ./application/Models/todo_m.php  */

?>