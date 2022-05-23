<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
    /* 공통 게시판 모델 */
    class Board_m extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        // function get_list($table = 'ci_board') {
        //     $sql = "SELECT * FROM ".$table." ORDER BY board_id DESC";
        //     $query = $this->db->query($sql);
        //     $result = $query->result();
        //     // $result = $query->result_array();

        //     return $result;
        // }

        // 페이징 소스 추가
        # 페이징 관련 파라미터가 있을 때의 처리와 두 번째 파라미터가 'count'일 때의 처리 추가
        function get_list($table = 'ci_board', $type = '', $offset = '', $limit = '') {
            $limit_query = '';

            if ($limit != '' OR $offset != '') {
                // 페이징이 있을 경우 처리
                $limit_query = ' LIMIT ' . $offset . ', ' .$limit;
            }

            $sql = "SELECT * FROM . $table . ORDER BY board_id DESC " . $limit_query;
            $query = $this->db->query($sql);

            if ($type == 'count') {
                $result = $query->num_rows();
            } else {
                $result = $query->result();
            }
            return $result;
        }
    }
?>

