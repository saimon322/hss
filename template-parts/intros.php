<?php if( have_rows('intro_slides') ): ?>
<?php while( have_rows('intro_slides') ): the_row(); ?>
    <div class="section section-intro">
        <section class="hss-intro hss-screen">
            <h5 class="hss-screen-title hss-intro__title">
                <?= get_sub_field('pre_title')?>            
            </h5>
            <div class="hss-screen-wrapper">
                <h2 class="hss-screen-main-title">
                    <?= get_sub_field('title')?>
                </h2>
                <div class="hss-screen-video hss-screen__video">
                    <iframe width="600" height="338" src="<?= get_sub_field('video')?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <p class="hss-screen-text">
                    <?= get_sub_field('text')?>
                </p>
            </div>
            <button class="hss-slide-arrow" data-slide-arrow>
                <?php if(get_sub_field('timeline_button')):?>
                    <span class="hss-slide-arrow__text">
                        <?= get_sub_field('timeline_button')?>
                    </span>                    
                <?php endif; ?>
                <svg width='38px' height='20px'>
                    <use xlink:href='#arrow'></use>
                </svg>
            </button>
        </section>
    </div> <!--intro-->
<?php endwhile; ?>
<?php endif; ?>