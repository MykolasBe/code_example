<h2>Hello <?php print $data['name'] ;?>,</h2>
<div class="profile-info">
    <p><span>Email:</span> <?php print $data['email'] ;?></p>
    <p><span>Phone:</span> +<?php print $data['phone'] ;?></p>
    <p><span>Registered at:</span> <?php print $data['register_time'] ;?></p>
    <p><span>Last login time:</span> <?php print $data['login_time'] ;?></p>
</div>
<div>
    <?php print $data['log_out_btn'];?>
</div>
