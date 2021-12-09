<?php
$post = $args['post'];
$terms = get_the_terms( $post, 'category' );
$terms = wp_list_pluck($terms, 'term_id');
$year = get_field('year', $post->ID);

$terms_str = '';
foreach ($terms as $term) {
    $terms_str .= ' cat-' . $term;
}

$int_decade = abs(round(($year - 5), -1));

$str_len = 300;
?>

<div class="section section-cat <?php echo $terms_str; ?>" data-decade="<?= $int_decade?>">
    <section class="hss-screen <?= get_field('slide_color', $post->ID) == 'black' ? 'hss-screen--dark' : ''?>" id="<?= $year?>">
        <div class="hss-back-banner">
            <?php echo wp_get_attachment_image(get_field('background_image', $post->ID), array(1920, 670), false, array('class' => 'hss-back-banner__img')); ?>
        </div>
        <h5 class="hss-screen-title">
            <?= get_field('pre-title', $post->ID)?>
        </h5>
        <div class="hss-screen-wrapper">
            <div class="hss-screen-year">
                <?= $year?>
            </div>
            <h2 class="hss-screen-main-title">
                <?= get_field('title', $post->ID)?>
            </h2>
            <div class="hss-screen-img-wrapper">
                <?php if(get_field('image_or_video', $post->ID) == 'video' && !empty(get_field('video', $post->ID))):?>
                    <iframe width="600" height="338" src="<?= get_field('video')?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php elseif (!empty(get_field('image', $post->ID))):
                    echo wp_get_attachment_image(get_field('image', $post->ID), 'large', false, array('class' => 'hss-screen-img hss-slide-3__img'));
                endif;?>
                <p class="hss-screen-img-description">
                    <?php if(!empty(get_field('image', $post->ID)) && !empty(get_field('image_description', $post->ID))){
                        echo get_field('image_description', $post->ID);
                    }?>
                </p>
            </div>
            <?php $read_more = strlen(get_field('description', $post->ID)) > $str_len; ?>
            <div class="hss-screen-text <?php echo ($read_more ? 'hss-screen-text--overflow' : '') ?>">
                <?= get_field('description', $post->ID)?>
            </div>
            <?php if($read_more): ?>
                <button class="hss-screen-read-more" data-open="#slide-<?= $post->ID?>-info">
                    READ MORE
                </button>
            <?php endif;?>
        </div>
        <button class="hss-slide-arrow" data-slide-arrow>
            <svg width='38px' height='20px'>
                <use xlink:href='#arrow'></use>
            </svg>
        </button>
        <?php if($read_more): ?>
            <div class="hss-info-screen" data-click-outside data-info-screen id="slide-<?= $post->ID?>-info">
                <button class="hss-info-screen__button" data-close="#slide-<?= $post->ID?>-info" data-close-delay="1500" data-close-styles="animation: from-left 1.5s ease-in-out forwards;">
                    <svg>
                        <use xlink:href='#close'></use>
                    </svg>
                </button>
                <div class="hss-info-screen__wrapper">
                    <?= get_field('description', $post->ID)?>
                </div>
            </div>
        <?php endif;?>
    </section>
</div>
