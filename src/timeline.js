const options = {
    root: null,
    rootMargin: '0px',
    threshold: 0.01,
}

let observer = new IntersectionObserver((entries) => {
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
            // entry.target.querySelector('.card').classList.remove('animate__animated', 'animate__fadeInLeft', 'animate__fadeInRight');
        }
    });
}, options);

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.timeline .registro')
        .forEach(registro => { observer.observe(registro) }
    );
});
