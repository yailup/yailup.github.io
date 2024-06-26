
let navBar = document.querySelector('#header')

document.addEventListener("scroll", ()=>{
    let scrollTop = window.scrollY

    if(scrollTop > 0){
        navBar.classList.add('roll')
    } else {
        navBar.classList.remove('roll')
    }

})

// script.js
window.addEventListener('scroll', function() {
    const footer = document.getElementById('footer');
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        footer.style.transform = 'translateY(0)';
    } else {
        footer.style.transform = 'translateY(100%)';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll to section when clicking on navigation links
    var scrollLinks = document.querySelectorAll('.scroll-down');
    
    scrollLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var targetId = this.getAttribute('href').substring(1);
            var targetSection = document.getElementById(targetId);
            var offsetTop = targetSection.offsetTop;
            
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        });
    });
});