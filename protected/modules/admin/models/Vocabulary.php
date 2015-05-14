<?php

/**
 * Description of Vocabulary
 *
 * @author HAO
 */
class Vocabulary extends VocabularyBase {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function defaultScope() {
        return array(
            'order' => 'weight desc'
        );
    }

}

?>
