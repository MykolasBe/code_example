<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <?php foreach ($data['head']['css'] ?? [] as $css):?>
        <link rel="stylesheet" href="<?php print $css;?>">
    <?php endforeach;?>

    <?php foreach ($data['head']['js'] ?? [] as $js):?>
        <script src="<?php print $js;?>>" defer></script>
    <?php endforeach;?>
    <title><?php print $data['head']['title'];?></title>
</head>
<body>
<header>
    <?php print $data['header'];?>
</header>
<main>
    <section class="container">
        <?php print $data['content'];?>
    </section>
</main>
<footer>
    <?php print $data['footer'];?>
</footer>
</body>
</html>