<?php

class TagController extends Our_Controller_Index {

    public function indexAction() {

        $tag = $this->getRequest()->get('tag');
        $page = $this->getRequest()->get('page', 1);
        $limit = 20;

        $Service_Arts_ListModel = new Service_Arts_ListModel();
        $num_of_arts = $Service_Arts_ListModel->cntArtsByTag($tag);
        $arts = $Service_Arts_ListModel->fndArtsByTag($tag, ($page-1)*$limit, $limit);

        $this->getView()->tag = $tag;
        $this->getView()->arts = $arts;
        $this->getView()->page_info = array('num_of_arts' => $num_of_arts,
                                            'page' => $page,
                                            'prev_page' => $page-1,
                                            'next_page' => $page+1,
                                            'pages' => ceil($num_of_arts/$limit));
    }


}