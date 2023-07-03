import Swal from "sweetalert2/src/sweetalert2.js";

document.addEventListener('DOMContentLoaded', function() {
    const getRealOffsetTop = function(element) {
        if (!element) return 0;
        return getRealOffsetTop(element.offsetParent) + element.offsetTop;
    };

    let list = document.querySelector('ul.ano-list');
    let sticky = getRealOffsetTop(list);
    let wpadminbar = document.querySelector('#wpadminbar');

    window.addEventListener('scroll', function() {
        if (window.innerWidth > 768 && window.pageYOffset > sticky) {
            list.classList.add('ano-list--sticky');

            if (wpadminbar) {
                list.style = 'top: ' + wpadminbar.offsetHeight + 'px;';
            }
        } else {
            list.classList.remove('ano-list--sticky');
            list.removeAttribute('style');
        }
    })

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    let num = 0;
                    let siblings = Array.from(entry.target.parentElement.children);

                    siblings.forEach((sib, i) => {
                        if (sib === entry.target) num = i;
                    });

                    entry.target.querySelector('.card').classList.add('animate__animated');

                    if (num % 2 === 0) {
                        entry.target.querySelector('.card').classList.add('animate__fadeInLeft');
                    } else {
                        entry.target.querySelector('.card').classList.add('animate__fadeInRight');
                    }
                } else {
                    /* Para esconder novamente os cards assim que saem do viewport. */
                    // entry.target.querySelector('.card').classList.remove('animate__animated', 'animate__fadeInLeft', 'animate__fadeInRight');
                }
            });
        },
        {
            root: null,
            rootMargin: '0px',
            threshold: 0.01,
        }
    );

    document.querySelectorAll('.timeline .registro').forEach(registro => {
        observer.observe(registro);
    });

    const updateRegistrosCount = function(link) {
        if (link) {
            let info = document.querySelector('.timeline-info');
            let count = link.dataset.posts;
            info.textContent = count + ' ' + ((count == 1) ? 'registro' : 'registros');
        }
    }

    updateRegistrosCount(document.querySelector('.ano-list__link.active'));

    const mu = new MutationObserver(function(mutationsList) {
        for (const mutation of mutationsList) {
            if (mutation.type === "attributes" && mutation.attributeName === "class" && mutation.target.classList.contains('active')) {
                updateRegistrosCount(mutation.target);
            }
        }
    });

    document.querySelectorAll('.ano-list__link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            let alvo = document.querySelector(e.target.getAttribute("href"));

            document.querySelectorAll('.timeline').forEach(function(timeline) {
                timeline.classList.remove('active');

                if (timeline === alvo) {
                    alvo.classList.add('animate__animated', 'animate__fadeIn', 'active');
                }
            });

            document.querySelectorAll('.ano-list__link').forEach(function(other) {
                other.classList.remove('active');
                other.setAttribute('aria-selected', 'false');
            });

            e.target.classList.add('active');
            e.target.setAttribute('aria-selected', 'true');

            return false;
        });

        mu.observe(link, {attributes: true});
    });

    document.querySelectorAll('[data-swal-template]').forEach(function(modal_toggle) {
        modal_toggle.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });

    Swal.bindClickHandler();
});
