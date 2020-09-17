<nav>
    <ul>
        <?php foreach ($data as $nav) :?>
            <li class="<?php print ($_SERVER['PHP_SELF'] == $nav['url']) ?  'active' : ''; ?>">
                <a href="<?php print $nav['url'];?>"><?php print $nav['page'];?></a>
                <?php if(array_key_exists('extra', $nav)): ?>
                    <ul class="menu-dropdown">
                        <i class="material-icons">expand_more</i>
                        <?php foreach ($nav['extra'] as $extra) :?>
                            <li>
                                <a href="<?php print $extra['url'];?>"><?php print $extra['page'];?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach;?>
    </ul>
</nav>
