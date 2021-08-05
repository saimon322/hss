<div class="hss-timeline" id="timeline">
    <div class="hss-timeline__wrapper">
        <button class="hss-timeline__start">
            <span>
                <?= get_field('top_button'); ?>   
            </span>
        </button>
        <?php $decades = get_decades();
        foreach ($decades as $i=>$decade):?>
            <button class="hss-timeline__point filter-btn filter-btn--<?= $decade?>" data-anchor="<?= $decade?>">
                <?= $decade?>
            </button>
        <?php endforeach;?>
        <div class="hss-timeline__pointer"></div>
        <button class="hss-timeline__button" data-open="#hss-filter">
            <span class="hss-timeline__button-text">
                <?= get_field('filter_btn'); ?>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><circle cx="25" cy="25" r="25" fill="#fff"/><path fill="none" stroke="#0081c8" stroke-width="2" d="M11 17h28"/><path fill="none" stroke="#0081c8" stroke-width="2" d="M11 25h28"/><path fill="none" stroke="#0081c8" stroke-width="2" d="M11 33h28"/><g class="settings-g-1" fill="#fff" stroke="#0081c8" stroke-width="2"><circle cx="5" cy="5" r="5" stroke="none"/><circle cx="5" cy="5" r="4" fill="none"/></g><g class="settings-g-2" fill="#fff" stroke="#0081c8" stroke-width="2"><circle cx="5" cy="5" r="5" stroke="none"/><circle cx="5" cy="5" r="4" fill="none"/></g></svg>
        </button>
        <div class="hss-filter hss-timeline__filter" id="hss-filter" data-click-outside>
            <div class="hss-filter__wrapper">
            <button class="hss-filter__close-button" data-close="#hss-filter" data-close-delay="1500" data-close-styles="animation: close-filter 1.5s ease-in-out forwards;">
                    <svg>
                        <use xlink:href='#close'></use>
                    </svg>
                </button>

                <h3 class="hss-filter__title">
                    <?= get_field('catrgories_title'); ?>
                </h3>
                <?php
                $terms = get_terms( 'category', [
                    'hide_empty' => false,
                ] );
                ?>
                <div class="hss-filter__filters">
                    <?php foreach ($terms as $term): ?>
                        <label class="hss-filter__category">
                            <input type="checkbox" 
                                   class="hss-filter__input" 
                                   value="<?= $term->term_id ?>" 
                                   name="<?= $term->term_id ?>">
                            <span class="hss-filter__input--custom"></span>
                            <span class="hss-filter__category-title">
                                <?= $term->name ?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <button class="hss-reset-button">
                    <?= get_field('reset_button'); ?>
                </button>
            </div>
        </div>
    </div>
</div> <!--Navigation-->
