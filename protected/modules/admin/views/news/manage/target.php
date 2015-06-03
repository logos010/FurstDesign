<?php
$this->pageTitle = 'News Target';
$this->breadcrumbs = array(
    'News' => array('index'),
    'News Target',
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?></h3>
    </div>
    <div class="panel-body">
        <div class="grid-view">
            <?php
            $term = Term::model()->findAll('status>0 AND parent_id = 0 order by weight desc');

            echo '<table class="items">';
            echo '<tr>'
            . '<td width="150">Chuyên Mục</td>'
            . '<td width="150">Chỉ tiêu</td>'
            . '<td width="150">Đã Up</td>'
            . '</tr>';

            foreach ($term as $node) {

                $count = News::model()->with(array('nTerms'))->count("nTerms.id={$node->id} AND t.create_time like '%{$date}%'");
                if ($count >= $target) {
                    $css = 'none';
                } else {
                    $css = 'required';
                }

                echo '<tr class="' . $css . '">';
                echo '<td>' . $node->name . '</td>';
                echo '<td>' . $target . '</td>';
                echo '<td>' . $count . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>  
        </div>
    </div>
</div>
<style>
    .required {color: red}
</style>
