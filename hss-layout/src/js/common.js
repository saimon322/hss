import fullpage from 'fullpage.js';

$(() => {
    const fpWrapper = document.querySelector('#fullpage');
    const topButton = document.querySelector('.hss-timeline__start');
    const anchors = document.querySelectorAll('[data-anchor]');
    const allSections = document.querySelectorAll('.section');
    const introSections = document.querySelectorAll('.section-intro');
    const slideSections = document.querySelectorAll('.section-cat');
    const timelinePointer = document.querySelector('.hss-timeline__pointer');
    const introsCount = introSections.length;
    const slidesCount = slideSections.length;
    const lastIntro = introSections[introsCount - 1];
    const timelineClass = 'timeline-show';
    const activeClass = 'hss-active';
    let filteredCount = slidesCount;
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
            timelinePointer.classList.remove(activeClass);
            anchors.forEach((anchor) => {
                anchor.classList.remove(activeClass);
            });

            if (filteredCount != 0) {
                skipPages(origin, destination, direction);
                if (destination.index < introsCount) {
                    document.body.classList.remove(timelineClass);
                } else {
                    document.body.classList.add(timelineClass);
                    const newDecade = destination.item.dataset.decade;
                    const newAnchors = document.querySelectorAll(`[data-anchor="${newDecade}"]`);
                    if (newAnchors.length) {
                        newAnchors.forEach((anchor) => {
                            anchor.classList.add(activeClass);
                        });
                        const anchorPos = newAnchors[0].offsetTop + newAnchors[0].offsetHeight;
                        timelinePointer.classList.add(activeClass);
                        timelinePointer.style.top = `${anchorPos}px`;
                    }
                }
            } else {
                if (destination.index < introsCount - 1) {
                    fullpage_api.setAllowScrolling(true, 'down');
                    document.body.classList.remove(timelineClass);
                } else {
                    fullpage_api.setAllowScrolling(false, 'down');
                    document.body.classList.add(timelineClass);
                }
            }

            activeSlide = $(destination.item);
        },
        afterLoad: (origin, destination, direction) => {
            if (filteredCount != 0) {
                if(destination.item.classList.contains('section--last')){
                    fullpage_api.setAllowScrolling(false, 'down');
                } else {
                    fullpage_api.setAllowScrolling(true, 'down');
                }
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
                const arraySections = Array.from(slideSections);
                const neededSectionIndex = arraySections.indexOf(neededSection);

                fullpage_api.moveTo(neededSectionIndex + introsCount + 1);
                mobileFiltersHide();
            });
        });

    // CATEGORIES FILTERS
    var filters = $('.hss-filter__input');
    filters.on('change', function() {
        $('.hss-listbox__item').removeClass(activeClass);
        if (!$('.hss-filter__input:checked').length) {
            resetFilters();
        } else {
            let filtersClasses = [];
            filters.each(function() {
                let filter = $(this);
                let term = filter.val();
                let checked = filter.is(':checked');
                if (checked) {
                    filtersClasses.push(`.cat-${term}`);
                    filter.parent('.hss-listbox__item').addClass(activeClass);
                }
            })

            $('.filter-btn').addClass('hidden');
            $('.section-cat').removeClass('filtered section--last').addClass('hidden');

            filteredCount = 0;
            $.each(filtersClasses, function(index, value){
                const filteredSections = $(`.section-cat${value}`);
                filteredCount += filteredSections.length;
                filteredSections.each(function(){
                    let section = $(this);
                    section.addClass('filtered').removeClass('hidden');
                    let decade = section.data('decade');
                    $(`.filter-btn[data-anchor='${decade}']`).removeClass('hidden');
                })
            })

            if (filteredCount == 0) {                
                lastIntro.classList.add('section--last');
            } else {
                lastIntro.classList.remove('section--last');
            }

            const firstFilteredSlide = $('.section-cat.filtered').first();
            const lastFilteredSlide = $('.section-cat.filtered').last();
            lastFilteredSlide.addClass('section--last');

            const newSlide = firstFilteredSlide.length ? 
                firstFilteredSlide.index() + 1 : 
                introsCount;
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
        $('.hss-listbox__item').removeClass(activeClass);
        $('.hss-filter__input').each(function( index ) {
            $(this).prop('checked', false );
        });
        $('.section-cat, .filter-btn').each(function( index ) {
            $(this).removeClass('filtered hidden section--last');
        });
        if (activeSlide.hasClass('section-cat')) {
            fullpage_api.moveTo(introsCount + 1);
        }
        fullpage_api.setAllowScrolling(true, 'down');
        mobileFiltersHide();
        filteredCount = slidesCount;
        lastIntro.classList.remove('section--last');
    }

    function mobileFiltersHide() {
        $('.hss-filter-mob-dropdown').removeClass('opened');
    }
})
