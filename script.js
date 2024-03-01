// Add 'scrolled' class to body when user scrolls past banner height
window.addEventListener('scroll', function() {
    var bannerHeight = document.querySelector('.banner').offsetHeight;

    if (window.scrollY > bannerHeight) {
        document.body.classList.add('scrolled');
    } else {
        document.body.classList.remove('scrolled');
    }
});
// Scroll to top when clicking on "Home" menu option
document.addEventListener('DOMContentLoaded', function() {
    var homeLink = document.querySelector('.scroll-to-top');

    homeLink.addEventListener('click', function(event) {
        event.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
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
