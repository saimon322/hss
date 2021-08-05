<?php
function hss_scripts() {
	wp_enqueue_style( 'hss', get_template_directory_uri() . '/hss-layout/dist/style.css', false, '1.1', 'all' );
	wp_enqueue_style( 'hss-adds', get_template_directory_uri() . '/style.css', false, '1.1', 'all' );
	
	wp_enqueue_script( 'hss', get_template_directory_uri() . '/hss-layout/dist/js/app.bundle.js', array( 'jquery' ), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'hss_scripts', 999 );


function sort_terms_clause( $orderby, $args, $taxonomies ) {
	return 't.term_id+0';
}

add_filter( 'get_terms_orderby', 'sort_terms_clause', 10, 3 );


function get_years() {
	$args = array(
		'status'         => 'published',
		'posts_per_page' => - 1,
		'meta_key'       => 'year',
		'orderby'        => 'meta_value',
		'order'          => 'ASC'
	);
	
	$posts = new WP_Query( $args );
	
	return $posts->posts;
}

function get_decades() {
	$years   = get_years();
	$decades = [];
	$counter = [];
	if ( ! empty( $years ) ) {
		foreach ( $years as $i => $year ) {
			$year_fld = get_field( 'year', $year->ID );
			if ( ! in_array( abs( round( ( $year_fld - 5 ), - 1 ) ), $decades ) ) {
				$decades[ $i ] = abs( round( ( $year_fld - 5 ), - 1 ) );
			}
		}
	}
	
	return $decades;
}

function get_mobile_cats() {
	ob_start();
	
	$terms = get_terms( 'category', [
		'hide_empty' => false,
	] );
	$count = 0;
	foreach ( $terms as $term ): ?>
        <label class="hss-listbox__item">
            <input type="checkbox" class="hss-filter__input" value="<?= $term->term_id ?>" name="<?= $term->term_id ?>">
            <span class="hss-filter__input--custom"></span>
            <?= $term->name ?>
            <span class="hss-listbox__item-amount">
                (<?= $term->count; ?>)
            </span>
        </label>
		<?php $count += $term->count;
	endforeach;
	
	$content = ob_get_contents();
	
	ob_end_clean();
	
	$all = '<label class="hss-listbox__item hss-reset-button">
                All
                <span class="hss-listbox__item-amount">
                    (' . $count . ')
                </span>
            </label> ';
	
	return $all . $content;
}

?>