<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
    /* 공통 게시판 모델 */
    class Board_m extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        // 페이징 소스 추가
        # 페이징 관련 파라미터가 있을 때의 처리와 두 번째 파라미터가 'count'일 때의 처리 추가
        function get_list($table = 'ci_board', $type = '', $offset = '', $limit = '', $search_word = '') {
            
            $sword = '';

            if ($search_word != '') {
                // 검색어 있을 경우
                $sword = 'WHERE subject like "%' . $search_word . '%" or contents like "%' . $search_word . '%" ';
            }

            $limit_query = '';

            if ($limit != '' OR $offset != '') {
                // 페이징이 있을 경우 처리
                $limit_query = ' LIMIT ' . $offset . ', ' .$limit;
            }

            $sql = "SELECT * FROM ci_board ORDER BY board_id DESC" . $limit_query;
            // $sql = "SELECT * FROM" . $table . $sword . "ORDER BY board_id DESC" . $limit_query; // 변수 참조는 mariaDB에서 안되는건가?
            $query = $this->db->query($sql);

            if ($type == 'count') {
                $result = $query->num_rows();
            } else {
                $result = $query->result();
            }
            return $result;
        }

        /* 게시물 상세보기 가져오기
         * 
         * @param string $table 게시판 테이블
         * @param string $id 게시물 번호
         * @return array
         * */
        function get_view($table, $id) {
            // 조회수 증가
            // $sql0 = "UPDATE" . $table . "SET hits = hits + 1 WHERE board_id='" . $id . "'";
            $sql0 = "UPDATE ci_board SET hits = hits + 1 WHERE board_id='" . $id . "'";
            $this -> db -> query($sql0);
 
            // $sql = "SELECT * FROM " . $table . " WHERE board_id = '" . $id . "'";
            $sql = "SELECT * FROM ci_board WHERE board_id = '" . $id . "'";
            $query = $this -> db -> query($sql);
    
            // 게시물 내용 반환
            $result = $query -> row();
    
            return $result;
        }

        /* 게시물 입력
         * 
         * @param array $arrays 테이블 명, 게시물 제목, 게시물 내용 1차 배열
         * @return boolean 입력 성공 여부
         * */
        function insert_board($arrays) {
            $insert_array = array(
                'board_pid' => 0,
                'user_id' => 'advisor',
                'user_name' => 'palpit',
                'subject' => $arrays['subject'],
                'contents' => $arrays['contents'],
                'reg_date' => date("Y-m-d H:i:s")
            );
            $result = $this->db->insert($arrays['table'], $insert_array);
            return $result;
        }
    
        function modify_board($arrays) {
            $modify_array = array(
                'subject' => $arrays['subject'],
                'contents' => $arrays['contents']
            );

            $where = array(
                'board_id' => $arrays['board_id']
            );

            $result = $this->db->update($arrays['table'], $modify_array, $where);

            return $result;
        }
    }
?>

