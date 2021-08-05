<?php get_header();?>

<main class="hss-main">
    <?php get_template_part('template-parts/timeline', 'filter')?>
    <?php get_template_part('template-parts/mobile', 'filters')?>
    
    <div id="fullpage">
        <?php get_template_part('main', 'page')?>

        <?php $years = get_field('years', 'option');
        $years = get_years();

        if(!empty($years)){
            foreach ($years as $i=>$year){
                    get_template_part('template-parts/content', 'years',  [ 'count' => count($years), 'current' => $i + 1, 'post' => $year]);
            }
            wp_reset_postdata();
        }?>

    </div>
</main>

<?php get_footer();?>
