<form class="hss-filter-mob" action="#">
    <ul class="hss-filter-mob__list">
        
        <li class="hss-filter-mob__item">
            <button class="hss-filter-mob__button" type="button" data-open="#mobile-filter-decade">
                Filter by Decade
            </button>
            <div class="hss-filter-mob__dropdown hss-filter-mob-dropdown" id="mobile-filter-decade">
                <div class="hss-filter-mob-dropdown__head">
                    <p class="hss-filter-mob-dropdown__title" id="hss-filter-mob-categories-elem">
                        Filter by Decade
                    </p>
                    <button class="hss-filter-mob-dropdown__close" type="button" data-close="#mobile-filter-decade">
                        <svg width="16" height="16">
                            <use xlink:href="#close"></use>
                        </svg>
                    </button>
                </div>
                <ul class="hss-filter-mob-dropdown__listbox hss-listbox" tabindex="0">
                    <?php $decades = get_decades();
                    foreach ($decades as $i=>$decade):?>
                        <li class="hss-listbox__item filter-btn filter-btn--<?= $decade?>" data-anchor="<?= $decade?>">
                            <?= $decade ?>
                        </li>
                    <?php endforeach;?>
                </ul><!-- / .listbox -->
            </div><!-- / .filter-dropdown -->
        </li>
        <li class="hss-filter-mob__item">
            <button class="hss-filter-mob__button" type="button" data-open="#mobile-filter-category">
                Filter by Category
            </button>
            <div class="hss-filter-mob__dropdown hss-filter-mob-dropdown" id="mobile-filter-category">
                <div class="hss-filter-mob-dropdown__head">
                    <p class="hss-filter-mob-dropdown__title" id="filter-sort-by-elem">
                        Filter by Category
                    </p>
                    <button class="hss-filter-mob-dropdown__close" type="button" data-close="#mobile-filter-category">
                        <svg width="16" height="16">
                            <use xlink:href="#close"></use>
                        </svg>
                    </button>
                </div>
                <div class="hss-filter-mob-dropdown__listbox hss-listbox" tabindex="0">
                    <?php echo get_mobile_cats(); ?>
                </div><!-- / .listbox -->
            </div><!-- / .filter-dropdown -->
        </li>
    </ul>
</form>
