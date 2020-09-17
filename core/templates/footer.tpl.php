 <footer>
     <ul>
         <?php foreach ($footer as $foot) :?>
            <li>
                <a href="<?php print $foot['url'];?>"><?php print $foot['page'];?></a>
            </li>
         <?php endforeach; ?>
     </ul>
     <p>© copyright <?php print  date('Y');?></p>
 </footer>
