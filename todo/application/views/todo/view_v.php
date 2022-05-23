<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
        <title>CodeIgniter</title>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link type="text/css" rel='stylesheet' href="/todo/include/css/bootstrap.css" />
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
                        <a rel="external" href="/todo/index.php/main/lists/">todo 애플리케이션 프로그램</a>
                    </li>
                </ul>
            </nav>
            <article id="board_area">
                <header>
                    <h1>Todo 조회</h1>
                </header>
                <table cellspacing="0" cellpadding="0" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $views -> id;?> 번 할일</th>
                            <th scope="col"><?php echo $views -> created_on;?></th>
                            <th scope="col"><?php echo $views -> due_date;?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="3">
                                <?php echo $views -> content;?>
                            </th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                <a href="/todo/index.php/main/lists/" class="btn btn-primary">목록</a>
                                <a href="/todo/index.php/main/delete/<?php echo $this -> uri -> segment(3); ?>" class="btn btn-danger">삭제</a>
                                <a href="/todo/index.php/main/write/" class="btn btn-success">쓰기</a>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </article>
            
        <footer>
            <blockquote>
                <p><a class="azubu" href="http://www.cikorea.net/" target="blank">CodeIgniter 한국 사용자 포럼</a></p>
                <small>Copyright by <em class="black"><a href="mailto:zhfldi4@gmail.com">Palpit</a></em></small>
            </blockquote>
        </footer>        
        </div>
    </body>
</html>