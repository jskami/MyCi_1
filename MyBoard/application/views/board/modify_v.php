<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/MyBoard/include/css/bootstrap.css"/>
    <script>
        $(document).ready(function() {
            $("#write_btn").click(function() {
                if ($("#input01").val() == '') {
                    alert('제목을 입력해 주세요.');
                    $("#input01").focus();
                    return false;
                } else if ($("#input02").val() == '') {
                    alert('내용을 입력해 주세요.');
                    $("#input02").focus();
                    return false;
                } else {
                    $("#write_action").submit();
                }
            });
        });
    </script>
</head>
<body>
    <div id="main">
        <header id="header" data-role="header" data-position="fixed">
            <blockquote>
                <p>
                    만들면서 배우는 CodeIgniter
                </p>
                <small>실행 예제</small>
            </blockquote>
        </header>
        <nav id="gnb">
            <ul>
                <li>
                    <a rel="external" href="/MyBoard/index.php/<?php echo $this -> uri -> segment(1); ?>/lists/<?php echo $this -> uri -> segment(3); ?>"> 게시판 프로젝트 </a>
                </li>
            </ul>
        </nav>
    <article id="board_area">
        <header>
            <h1></h1>
        </header>
        <form class="form-horizontal" method="post" action="" id="write_action">
            <fieldset>
                <legend>
                    게시물 수정
                </legend>
                <div class="control-group">
                    <label class="control-label" for="input01">제목</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input01" name="subject"
                            value="<?php echo $views->subject; ?>"/>
                    </div>
                    <label class="control-label" for="input02">내용</label>
                    <div class="controls">
                        <textarea class="input-xlarge" id="input02" name="contents" rows="5">
                            <?php echo $views->contents;?>
                        </textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="write_btn">
                            수정
                        </button>
                        <button class="btn" onclick="document.location.reload()">
                            취소
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </article>
    <footer id="footer">
    <dl>
        <dt>
            <a class="azubu" href="http://www.cikorea.net/" target="blank"> CodeIgniter 한국 사용자포럼 </a>
        </dt>
        <dd>
            Copyright by <em class="black">jskami</em>.
        </dd>
    </dl>
</footer>
 
</div>
</body>
</html>