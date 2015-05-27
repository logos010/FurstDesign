<?php  foreach ($menu as $k => $v): ?>
    <?php //var_dump($v->hasChild($v->id)); ?>
    <?php if ($v->hasChild($v->id)): ?>
        <li class="dropdown"><a href="<?php echo $v->url; ?>" class="primary" ><?php echo $v->name; ?></a>
            <ul>
            <?php 
                $subMenu = $v->hasChild($v->id); 
                foreach ($subMenu as $sk => $sv):
            ?>
                <li><a href="<?php echo $sv->url; ?>"><?php echo $sv->name; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </li>
    <?php else: ?>
        <li><a href="<?php echo $v->url; ?>"><?php echo $v->name; ?></a></li>
    <?php endif; ?>
<?php endforeach; ?>
</ul>


    
