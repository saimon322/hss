<?php
?>

<div class="section">
    <section class="hss-screen">
        <div class="hss-back-banner">
            <?php echo wp_get_attachment_image(get_field('background_image'), array(1920, 670), false, array('class' => 'hss-back-banner__img')); ?>
        </div>
        <a href="/" class="hss-logo">
            <?php echo wp_get_attachment_image(get_field('logo'), array(85, 85), false); ?>
        </a>
        <div class="hss-screen-wrapper">
            <h2 class="hss-title--h2 hss-main-screen__subtitle">
                <?= get_field('pre-title')?>
            </h2>
            <h1 class="hss-title--h1 hss-main-screen__title">
                <?= get_field('title')?>
            </h1>
            <p class="hss-main-screen__text">
                <?= get_field('sub-title')?>
            </p>
        </div>
        <button class="hss-slide-arrow" data-slide-arrow>
            <svg width='38px' height='20px'>
                <use xlink:href='#arrow'></use>
            </svg>
        </button>
    </section>
</div> <!--First screen-->

<div class="section">
    <section class="hss-introduction hss-screen">
        <h5 class="hss-screen-title hss-introduction__title">
            <?= get_field('intro_pretitle')?>            
        </h5>
        <div class="hss-screen-wrapper">
            <h2 class="hss-screen-main-title">
                <?= get_field('intro_title')?>
            </h2>
            <div class="hss-screen-video hss-screen__video">
                <iframe width="600" height="338" src="<?= get_field('intro_video')?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <p class="hss-screen-text">
                <?= get_field('intro_sub_title')?>
            </p>
        </div>
        <button class="hss-slide-arrow" data-slide-arrow>
                    <span class="hss-slide-arrow__text">
                        <?= get_field('timeline_button')?>
                    </span>
            <svg width='38px' height='20px'>
                <use xlink:href='#arrow'></use>
            </svg>
        </button>
    </section>
</div> <!--Introduction-->
