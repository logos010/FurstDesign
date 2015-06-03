<?php foreach ($menu as $k => $v): ?>    
    <?php if ($v->hasChild($v->id)): ?>
        <li class="dropdown"><a href="<?php echo App()->controller->createUrl($v->url); ?>" class="primary" ><?php echo $v->name; ?></a>
            <ul>
                <?php
                $subMenu = $v->hasChild($v->id);
                foreach ($subMenu as $sk => $sv):
                    ?>
                    <li><a id="1" href="<?php echo App()->controller->createUrl($sv->url); ?>"><?php echo $sv->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php else: ?>
        <li><a href="<?php echo App()->controller->createUrl($v->url); ?>"><?php echo $v->name; ?></a></li>
    <?php endif; ?>
<?php endforeach; ?>

<div class="spacer2"></div>
<?php foreach ($news as $k => $v): ?>
    <li class="dropdown"><a href="<?php echo App()->controller->createUrl($v->url); ?>" class="primary" ><?php echo $v->name; ?></a>
        <ul>
            <?php
            $subMenu = $v->hasChild($v->id);
            foreach ($subMenu as $sk => $sv):
                ?>
                <li><a id="1" href="<?php echo App()->controller->createUrl($sv->url); ?>"><?php echo $sv->name; ?></a></li>
                <?php endforeach; ?>
        </ul>
    </li>
<?php endforeach; ?>





