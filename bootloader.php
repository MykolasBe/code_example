<?php
declare(strict_types=1);
session_start();
define('ROOT',__DIR__);
define('DB_FILE', ROOT . '/app/data/db.json');

date_default_timezone_set('Europe/Vilnius');

//Load core functions
require ROOT . '/core/functions/file.php';
require ROOT . '/core/functions/form/core.php';
require ROOT . '/core/functions/form/validators.php';
require ROOT . '/core/functions/html.php';

//load app functions
require ROOT . '/app/functions/form/validators.php';

// load classes
require 'vendor/autoload.php';

require ROOT .  '/app/config/routes.php';

$app = new App\App();

