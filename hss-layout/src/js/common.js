import fullpage from 'fullpage.js';

$(() => {
    const fpWrapper = document.querySelector('#fullpage');
    const topButton = document.querySelector('.hss-timeline__start');
    const anchors = document.querySelectorAll('[data-anchor]');
    const allSections = document.querySelectorAll('.section');
    const sections = document.querySelectorAll('.section-cat');
    const startSectionsNum = allSections.length - sections.length;
    const slidesCount = sections.length;
    const timelineClass = 'timeline-show';
    let activeSlide;

    const slideArrows = document.querySelectorAll('[data-slide-arrow]');
    slideArrows.forEach((arrow) => {
        arrow.addEventListener('click', () => {
            let currentSlide = activeSlide.index() - 1;
            // last slide arrow up
            if (arrow.closest('.section--last') || (currentSlide == slidesCount)) {
                fullpage_api.moveSectionUp();
            // all others down
            } else {
                fullpage_api.moveSectionDown();
            }
        });
    });

    // Fullpage init
    new fullpage('#fullpage', {
        licenseKey: '28B27742-9C0644F4-853CD239-DCF3F188',
        onLeave: (origin, destination, direction) => {
            skipPages(origin, destination, direction);

            if (destination.index < startSectionsNum) {
                document.body.classList.remove(timelineClass);
            }
            
            const oldAnchors = document.querySelectorAll('.filter-btn.hss-active');
            const newDecade = destination.item.dataset.decade;
            const newAnchors = document.querySelectorAll(`[data-anchor="${newDecade}"]`);
            if (oldAnchors.length) {
                const oldDecade = oldAnchors[0].dataset.anchor;
                if (oldDecade != newDecade) {
                    oldAnchors.forEach((anchor) => {
                        anchor.classList.remove('hss-active');
                    });
                }
            }
            if (newAnchors.length) {
                newAnchors.forEach((anchor) => {
                    anchor.classList.add('hss-active');
                });
            }

            activeSlide = $(destination.item);
        },
        afterLoad: (origin, destination, direction) => {
            if (destination.index >= startSectionsNum) {
                document.body.classList.add(timelineClass);
            }
            if(destination.item.classList.contains('section--last')){
                fullpage_api.setAllowScrolling(false, 'down');
            } else {
                fullpage_api.setAllowScrolling(true, 'down');
            }
        },
    });

    function skipPages(origin, destination, direction){
        if(destination.item.classList.contains('hidden')){
            let destinationIndex;
            if(direction === 'down'){
                destinationIndex = destination.index + 2;
            }else{
                destinationIndex = destination.index;
            }
    
            setTimeout(function(){
                fullpage_api.moveTo(destinationIndex);
            });
        }
    }

    // SCROLL TO THE FIRST SLIDE
    topButton && topButton.addEventListener('click', () => {
        fullpage_api.moveTo(1);
    });

    // DECADES SECTION SCROLL
    anchors &&
        anchors.forEach((anchor) => {
            anchor.addEventListener('click', () => {
                const neededDecade = anchor.dataset.anchor;
                const neededSection = document.querySelector(`[data-decade="${neededDecade}"]`);
                const arraySections = Array.from(sections);
                const neededSectionIndex = arraySections.indexOf(neededSection);

                fullpage_api.moveTo(neededSectionIndex + startSectionsNum + 1);
                mobileFiltersHide();
            });
        });
    anchors[0].classList.add('hss-active');

    // CATEGORIES FILTERS
    var filters = $('.hss-filter__input');
    filters.on('change', function() {
        $('.hss-listbox__item').removeClass('hss-active');
        if (!$('.hss-filter__input:checked').length) {
            resetFilters();
        } else {
            let filtersClasses = '';
            filters.each(function() {
                let filter = $(this);
                let term = filter.val();
                let checked = filter.is(':checked');
                if (checked) {
                    filtersClasses += `.cat-${term}`;
                    filter.parent('.hss-listbox__item').addClass('hss-active');
                }
            })

            $('.filter-btn').addClass('hidden');
            $('.section-cat').removeClass('filtered section--last').addClass('hidden');
            $(`.section-cat${filtersClasses}`).each(function(){
                let section = $(this);
                section.addClass('filtered').removeClass('hidden');
                let decade = section.data('decade');
                $(`.filter-btn[data-anchor='${decade}']`).removeClass('hidden');
            })

            const firstFilteredSlide = $('.section-cat.filtered').first();
            const lastFilteredSlide = $('.section-cat.filtered').last();
            lastFilteredSlide.addClass('section--last');

            const newSlide = firstFilteredSlide.length ? 
                  firstFilteredSlide.index() + 1 : 
                  startSectionsNum;
            if (activeSlide.hasClass('hidden')) {
                fullpage_api.moveTo(newSlide);
            }
            setTimeout(() => {
                fullpage_api.reBuild();
            }, 500)

            fullpage_api.setAllowScrolling(true, 'down');
            if(activeSlide.hasClass('section--last')){
                fullpage_api.setAllowScrolling(false, 'down');
            }
        }
        mobileFiltersHide();
    });

    $('.hss-reset-button').on('click', function() {
        resetFilters();
    });

    function resetFilters() {
        $('.hss-listbox__item').removeClass('hss-active');
        $('.hss-filter__input').each(function( index ) {
            $(this).prop('checked', false );
        });
        $('.section-cat, .filter-btn').each(function( index ) {
            $(this).removeClass('filtered hidden section--last');
        });
        if (activeSlide.hasClass('section-cat')) {
            fullpage_api.moveTo(startSectionsNum + 1);
        }
        fullpage_api.setAllowScrolling(true, 'down');
        mobileFiltersHide();
    }

    function mobileFiltersHide() {
        $('.hss-filter-mob-dropdown').removeClass('opened');
    }
})