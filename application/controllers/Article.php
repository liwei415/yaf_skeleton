<?php

class ArticleController extends Our_Controller_Index {

    public function indexAction() {

        $a_id = $this->getRequest()->get('id', 1);

        $Service_Arts_DetailModel = new Service_Arts_DetailModel();
        $art = $Service_Arts_DetailModel->fndArt($a_id);
        $prev_art = $Service_Arts_DetailModel->fndPrevArt($a_id);
        $next_art = $Service_Arts_DetailModel->fndNextArt($a_id);

        $this->getView()->art = $art;
        $this->getView()->prev_art = $prev_art;
        $this->getView()->next_art = $next_art;
    }


}
