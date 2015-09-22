<?php
    require('config.php');
    if( isset( $_REQUEST['keyword'] ) )
    {
 
        $keyword        =       $_REQUEST['keyword'];
        $query          =       "SELECT * from questions WHERE title LIKE '$keyword%' LIMIT 10";
        $result         =       $mysqli->query($query);
        $html           =       "";
        while ( $row    =       $result->fetch_object() )
        {
            $html   .='<li class="onclick-menu-content">'.$row->title.'</li><hr/>';
        }
 
        echo $html;
 
    }
?>