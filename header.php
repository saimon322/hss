<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A living history of sports medicine">
    <meta property="og:title" content="HSS Sports Medicine Institute">
    <meta property="og:description" content="A living history of sports medicine">
    <meta property="og:image" content="<?=get_template_directory_uri();?>/img/og_image.jpg">

    <title>HSS Sports Medicine Institute</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?=get_template_directory_uri();?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=get_template_directory_uri();?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=get_template_directory_uri();?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?=get_template_directory_uri();?>/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?=get_template_directory_uri();?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
    
    <?php wp_head();?>
</head>

<body>
    <header class="hss-header">
        <div class="hss-header__wrapper">
            <button class="hss-header__burger-button hss-burger-button hss-header__button">
                <svg width='20px' height='13px'>
                    <use xlink:href='#burger-button'></use>
                </svg>
            </button>
            <a href="#" class="hss-header__logo hss-header__logo--small">
                <?php echo wp_get_attachment_image(get_field('logo', 'option'), array(85, 85), false, array('class' => 'hss-header__logo-img')); ?>
            </a>
            <button class="hss-header__search-button hss-search-button hss-header__button">
                <svg width='18px' height='12px'>
                    <use xlink:href='#search'></use>
                </svg>
            </button>
        </div>
    </header>
