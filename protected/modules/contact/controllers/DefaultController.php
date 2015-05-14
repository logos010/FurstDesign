<?php

class DefaultController extends ControllerBase {

    public function actionIndex() {
        $this->layout = '//layouts/main';
        $model = new Contact;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Contact'])) {
            $model->attributes = $_POST['Contact'];
            if ($model->save()) {
                
                $from = array($model->email => $model->fullname);
                $to = array(UConfig::get('email', 'contact'));
                $subject = 'Customer Contact: '.$model->title;
                $content = "<p>Khách Hàng: {$model->fullname}, SDT: {$model->phone}</p><p><i>Liên lạc TGNH với nội dung:</i></p>" . $model->content;
                
                if(UMail::send($from, $to, $subject, $content)){
                    $this->setFlash(UTranslate::t('Thank you for contacting us. We will respond to you as soon as possible.'));
                }
                $this->refresh();		
            }
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contact-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}