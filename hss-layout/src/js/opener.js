const openedClass = 'opened';
const closingClass = 'closing';

const listenOpening = (openingElements) => {
    if (!openingElements) {
        return;
    }

    openingElements.forEach((openingElement) => {

        const targeElement = document.querySelector(
            openingElement.dataset.open
        );

        if (!targeElement) {
            return;
        }

        openingElement.addEventListener('click', () => {
            targeElement.classList.add(openedClass);

            if (openingElement.classList.contains('hss-screen-read-more')) {
                fullpage_api.setAllowScrolling(false);
            }
        });

        const clickOutside = targeElement.hasAttribute('data-click-outside');
        clickOutside && window.addEventListener('mouseup', function (e) {
            if (targeElement.classList.contains(openedClass)) {
                if (!targeElement.contains(e.target)) {
                    const closeBtn = targeElement.querySelector('[data-close]');
                    closeBtn && closeBtn.click();
                }
            }
        }, {passive: true});
    });
};

const listenClosing = (closingElements) => {
    if (!closingElements) {
        return;
    }

    closingElements.forEach((closingElement) => {
        const { closeDelay, closeStyles, close } = closingElement.dataset;
        const targeElements = document.querySelectorAll(close);

        if (!targeElements) {
            return;
        }

        const removeStyle = () => {
            targeElements.forEach((targeElement) => {
                targeElement.removeAttribute('style');
            });
        };

        const addClosingClass = () => {
            targeElements.forEach((targeElement) => {
                targeElement.classList.add(closingClass);
            });
        };

        const removeClosingClass = () => {
            targeElements.forEach((targeElement) => {
                targeElement.classList.remove(closingClass);
            });
        };

        const removeOpenedClass = () => {
            targeElements.forEach((targeElement) => {
                targeElement.classList.remove(openedClass);
            });
        };

        const getCloseDelay = (delay) =>
            new Promise((resolve) =>
                setTimeout(() => {
                    removeStyle();
                    removeClosingClass();
                    resolve();
                }, delay)
            );

        closingElement.addEventListener('click', async () => {
            fullpage_api.setAllowScrolling(true);
            if (closeStyles) {
                targeElements.forEach((targeElement) => {
                    targeElement.setAttribute('style', closeStyles);
                });
            }

            if (closeDelay) {
                addClosingClass();
                await getCloseDelay(closeDelay);
            } else {
                removeStyle();
            }

            removeOpenedClass();
        });
    });
};

listenOpening(document.querySelectorAll('[data-open]'));
listenClosing(document.querySelectorAll('[data-close]'));