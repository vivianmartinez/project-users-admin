<?php

class PaginateData{
    //paginate data whit result in descending order
    static public function paginateDataDsc($records,$records_per_page){
       
        $pages = ceil($records / $records_per_page); 
        $page = 1;
        $offset = $records_per_page > $records ? 0 : $records - $records_per_page;

        if(isset($_GET['page'])){
            if($_GET['page'] <= $pages && $_GET['page'] > 0){
              $offset = 0;
              $page = intval($_GET['page']);
              if( ($page * $records_per_page) < $records){
                 $offset = $records - ($page * $records_per_page);
              }
            }else{
                $_SESSION['error_pagination'] = ['pages'=>'the page number doesn\'t exists.'];
            }
        }
        $limit   = ($page * $records_per_page) > $records ? $records % $records_per_page : $records_per_page;
        $preview = ($page - 1) < 1 ? 1 : $page - 1;
        $next    = ($page + 1) > $pages ? $pages : $page + 1;

        return ['pages' => $pages,'limit' => $limit, 'offset' => $offset,'preview' => $preview,'next' => $next];
    }
}