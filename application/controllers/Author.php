<?php

class AuthorController extends Our_Controller_Index {

    public function indexAction() {

        $u_id = $this->getRequest()->get('id', 1);
        $page = $this->getRequest()->get('page', 1);
        $limit = 20;

        $Service_Arts_ListModel = new Service_Arts_ListModel();
        $num_of_arts = $Service_Arts_ListModel->cntArtsByAuthor($u_id);
        $arts = $Service_Arts_ListModel->fndArtsByAuthor($u_id, ($page-1)*$limit, $limit);

        $Service_Users_UserModel = new Service_Users_UserModel();
        $author =$Service_Users_UserModel->fndUsers($u_id);

        $this->getView()->author = $author;
        $this->getView()->arts = $arts;
        $this->getView()->page_info = array('num_of_arts' => $num_of_arts,
                                            'page' => $page,
                                            'prev_page' => $page-1,
                                            'next_page' => $page+1,
                                            'pages' => ceil($num_of_arts/$limit));
    }


}
