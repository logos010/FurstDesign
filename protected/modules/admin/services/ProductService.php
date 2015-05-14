<?php

/**
 * Description of ProductService
 *
 * @author HAO
 */
class ProductService extends GenericService {

    //put your code here
    public function init($module) {
        parent::init($module);
        $this->criteria->select = '*';
        // Add more criteria
    }

    public function search($model = null) {
        if (is_array($model)) {
            foreach ($model as $key => $value) {
                $this->criteria->$key = $value;
            }
        } else if ($model instanceof Product) {
            $this->criteria->compare('t.id', $model->id);
            $this->criteria->compare('t.name', $model->name, true);
            // Add more criteria
        }

        $this->getPage(Product::model()->resetScope()->count($this->criteria));
        $data = Product::model()->resetScope()->findAll($this->criteria);
        
        return $this->getResult($data);
    }

}
