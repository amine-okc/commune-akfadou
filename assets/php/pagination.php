<?php if (isset($total_pages) && $total_pages > 1) { ?>
    <style>
        .pagination .page-link.first {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .pagination .page-link.last {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .pages{
            position: absolute;
            margin : 0 auto;
        }
    </style>
    <nav class="text-center">
        
        <ul class="pagination">
            
            <?php 
            if(isset($data))
                $url =$_SERVER["PHP_SELF"].'?'. http_build_query($data) . "&pageno=";
            else 
            $url =$_SERVER["PHP_SELF"].'?'. "&pageno=";?>
            <li class="page-item"><a class="page-link first" href="<?php echo $url.'1'?>" style="<?php if ($pageno == 1) {
                                                                                            echo " background-color : rgb(13,110,253); color : white";
                                                                                        }  ?>">1</a></li>
            <li class="page-item"><a class="page-link" href="#" style="display : <?php if ($pageno <= 2 || $pageno - 1 == 2) echo "none" ?>">...</a></li>
            <li class="page-item" style="display : <?php if ($pageno <= 2 || $pageno > $total_pages) echo "none" ?>">
                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                echo '#';
                                            } else {
                                                 echo $url . ($pageno - 1);
                                            } ?>"><?php echo $pageno - 1 ?></a>
            </li>
            <?php if ($pageno <= $total_pages) {
                
            ?>
                <li class="page-item">
                    <a class="page-link" href="#" style="background-color : rgb(13,110,253); color : white; <?php if ($pageno == 1 || $pageno == $total_pages) echo "display : none" ?>"><?php echo $pageno ?></a>
                </li>
            <?php } ?>
            <li class="page-item" style="display : <?php if ($pageno >= $total_pages - 1 || $pageno > $total_pages) echo "none" ?>">
                <a class="page-link" href="<?php if ($pageno == $total_pages) {
                                                echo '#';
                                            } else {
                                                echo $url . ($pageno + 1);
                                            } ?>">
                    <?php echo $pageno + 1 ?>
                </a>
            </li>
            <li class="page-item" style="display : <?php if ($pageno >= $total_pages - 1 || $pageno + 1 == $total_pages - 1) echo "none" ?>">
                <a class="page-link" href="#"><?php echo "..." ?></a>
            </li>
            <li class="page-item">
                
                <a class="page-link last" href="<?php echo $url.$total_pages; ?>" style="<?php if ($pageno == $total_pages) {
                                                                                                echo " background-color : rgb(13,110,253); color : white";
                                                                                            } ?>"><?php echo $total_pages ?></a>
            </li>
        </ul>
    </nav><?php } ?>