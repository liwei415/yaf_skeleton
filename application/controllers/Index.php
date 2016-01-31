<?php

class IndexController extends Our_Controller_Index {

    public function indexAction() {

        $page = $this->getRequest()->get('page', 1);
        $limit = 20;

        $Service_Arts_ListModel = new Service_Arts_ListModel();
        $num_of_arts = $Service_Arts_ListModel->cntArts();

        $arts = $Service_Arts_ListModel->fndArts(($page-1)*$limit, $limit);

        $this->getView()->arts = $arts;
        $this->getView()->page_info
            = array('page' => $page,
                    'prev_page' => $page-1,
                    'next_page' => $page+1,
                    'pages' => ceil($num_of_arts/$limit));
    }

    public function testAction() {
        //phpinfo();
    }


}
