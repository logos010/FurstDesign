<?php

class NewsController extends ControllerBase{
    
    public $defaultController = 'index';
    
    public function actionCate($tid){
        $news = News::model()->with(array(
            'nTerms' => array(
                'condition' => 'tid = :tid',
                'params' => array(
                    ':tid' => $tid,
                ),
            )
        ))->findAll();
        
        if (!is_null($news)){
            $this->render('news', array(
                'news' => $news
            ));
        }
    }
    
    public function actionDetail($nid){
        $newsDetail = News::model()->find(array(
            'condition' => 'id=:nid',
            'params' => array(
                ':nid' => $nid
            )
        ));
        
        if(!is_null($newsDetail)){
            $this->render('detail', array(
                'detail' => $newsDetail
            ));
        }
    }
}
