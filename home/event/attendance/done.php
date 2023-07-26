<html>
    <head>
    </head>
    <body>
        <div class="row" align="center">
            <div class="col-8-lg">
                <?php
                        if(isset($_REQUEST['msg'])){
                            #print_r('<p>'.$_REQUEST['id'].' : '.$_REQUEST['msg'].'</p>');
                            print_r('<p>'.$_REQUEST['msg'].'</p>');
                        }
                ?>
            </div>
        </div>
    </body>
</html>


