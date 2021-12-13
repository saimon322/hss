<?php $home_slide = get_field('home_slide') ?>
<div class="section section-intro">
    <section class="hss-screen">
        <div class="hss-back-banner">
            <?php echo wp_get_attachment_image($home_slide['bg'], array(1920, 670), false, array('class' => 'hss-back-banner__img')); ?>
        </div>
        <a href="/" class="hss-logo">
            <?php echo wp_get_attachment_image($home_slide['logo'], array(85, 85), false); ?>
        </a>
        <div class="hss-screen-wrapper">
            <h2 class="hss-title--h2 hss-main-screen__subtitle">
                <?= $home_slide['pre_title']?>
            </h2>
            <h1 class="hss-title--h1 hss-main-screen__title">
                <?= $home_slide['title']?>
            </h1>
            <div class="hss-screen-text">
                <?= $home_slide['text']?>
            </div>
        </div>
        <button class="hss-slide-arrow" data-slide-arrow>
            <svg width='38px' height='20px'>
                <use xlink:href='#arrow'></use>
            </svg>
        </button>
    </section>
</div> <!--First screen-->