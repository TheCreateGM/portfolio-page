// JavaScript for Animate on Scroll using Intersection Observer

document.addEventListener('DOMContentLoaded', () => {
    // Select all elements with the 'fade-in-section' class
    const fadeElements = document.querySelectorAll('.fade-in-section');

    const observerOptions = {
        root: null, // Use the viewport as the root
        rootMargin: '0px', // No margin around the root
        threshold: 0.1 // Trigger when 10% of the element is visible
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add the 'is-visible' class when the element enters the viewport
                entry.target.classList.add('is-visible');
                // Optionally stop observing after it's visible
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe each fade-in element
    fadeElements.forEach(element => {
        observer.observe(element);
    });
});

// Note: Navbar scroll shadow handled by Alpine.js in header.php