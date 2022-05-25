<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <title>CodeIgniter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link type="text/css" rel="stylesheet" href="/bbs/include/css/bootstrap.css" />
        <script>
            $(document).ready(function() {
                $("#search_btn").click(function() {
                    if ($("#q").val() == '') {
                        alert("검색어를 입력하세요!");
                        return false;
                    } else {
                        var act = "/Myboard/index.php/board/lists/ci_board/q/" + $("#q").val() + "/page/1";
                        $("#bd_search").attr('action', act).submit();
                    }
                });
            });
 
            function board_search_enter(form) {
                var keycode = window.event.keyCode;
                if (keycode == 13)
                    $("#search_btn").click();
            }
       </script>
    </head>
    <body>
        <div id="main">
            
            <article id="board_area">
                <header>
                    <h1></h1>
                </header>
                <table cellspacing="0" cellpadding="0" class="table table-striped" border="2">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $views -> subject;?></th>
                            <th scope="col">이름: <?php echo $views -> user_name;?></th>
                            <th scope="col">조회수: <?php echo $views -> hits;?></th>
                            <th scope="col">등록일: <?php echo $views -> reg_date;?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="4">
                                <?php echo $views -> contents;?>
                            </th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                <a href="/Myboard/index.php/board/lists/<?php echo $this -> uri -> segment(3); ?>/
                                    page/<?php echo $this -> uri -> segment(7); ?>" class="btn btn-primary">목록 </a>
                                <a href="/Myboard/index.php/board/modify/<?php echo $this -> uri -> segment(3); ?>/board_id/
                                    <?php echo $this -> uri -> segment(4); ?>/page/<?php echo $this -> uri -> segment(7); ?>"
                                    class="btn btn-warning"> 수정 </a>
                                <a href="/Myboard/index.php/board/delete/<?php echo $this -> uri -> segment(3); ?>/board_id/
                                    <?php echo $this -> uri -> segment(5); ?>/page/<?php echo $this -> uri -> segment(7); ?>"
                                    class="btn btn-danger"> 삭제 </a>
                                <a href="/Myboard/index.php/board/write/<?php echo $this -> uri -> segment(3); ?>/page/<?php echo $this -> uri -> segment(7); ?>"
                                    class="btn btn-success">쓰기</a>                    
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </article>
            
        </div>
    </body>
</html>