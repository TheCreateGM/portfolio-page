$(document).ready(function() {

    // --- Theme Toggle ---
    const themeToggle = $('#theme-toggle');
    const body = $('body');
    const toggleIcon = themeToggle.find('img');

    function applyTheme(theme) {
        if (theme === 'dark') {
            body.attr('data-theme', 'dark');
            if(toggleIcon.length) toggleIcon.attr('src', body.attr('data-base-url') + 'img/sun.png');
            localStorage.setItem('theme', 'dark');
        } else {
            body.attr('data-theme', 'light');
             if(toggleIcon.length) toggleIcon.attr('src', body.attr('data-base-url') + 'img/moon.png');
            localStorage.setItem('theme', 'light');
        }
    }

    // Apply saved theme or preference on load
    const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
     // Add base URL attribute to body for JS pathing if needed elsewhere
     // Detect base url (simple version, might need adjustment depending on server config/subdirs)
     let baseUrl = window.location.pathname.split('/').slice(0,-1).join('/') + '/';
     if (baseUrl === '//') baseUrl = '/'; // Adjust for root
     // A better approach might be setting it via PHP in the body tag if structure is complex
     body.attr('data-base-url', ''); // Assuming running from root htdocs


    applyTheme(currentTheme === 'dark' || (!currentTheme && prefersDark) ? 'dark' : 'light');

    // Toggle theme on button click
    themeToggle.on('click', function() {
        const newTheme = body.attr('data-theme') === 'dark' ? 'light' : 'dark';
        applyTheme(newTheme);
    });

    // --- Bulma Navbar Burger Toggle ---
    $(".navbar-burger").on('click', function() {
        $(this).toggleClass("is-active");
        $("#" + $(this).data("target")).toggleClass("is-active");
    });

    // --- Laptop Scroll Animation (Anime.js) ---
    const animationContainer = $('#laptop-animation-container');
    if (animationContainer.length) { // Only run if the container exists on the page
        animationContainer.show(); // Make container visible

        const components = [
            { id: '#anim-board', start: 0.1, end: 0.3 },
            { id: '#anim-cpu',   start: 0.2, end: 0.4 },
            { id: '#anim-ram',   start: 0.3, end: 0.5 },
            { id: '#anim-gpu',   start: 0.4, end: 0.6 },
            { id: '#anim-ssd',   start: 0.5, end: 0.7 }
        ];

        let isAnimating = {}; // Track animation state per component
        components.forEach(c => isAnimating[c.id] = false);

        // Simple debounce function
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        const handleScrollAnimation = () => {
            const scrollPercent = $(window).scrollTop() / ($(document).height() - $(window).height());

            components.forEach(comp => {
                const shouldBeVisible = scrollPercent >= comp.start && scrollPercent < comp.end;
                const isVisible = $(comp.id).css('opacity') > 0; // Check current state

                if (shouldBeVisible && !isVisible && !isAnimating[comp.id]) {
                    isAnimating[comp.id] = true;
                    anime({
                        targets: comp.id,
                        opacity: [0, 1],
                        translateY: [20, 0], // Example: slide in
                        scale: [0.8, 1],     // Example: scale up
                        rotate: [anime.random(-10, 10), 0], // Example: slight rotation
                        easing: 'easeOutExpo',
                        duration: 800,
                        complete: () => { isAnimating[comp.id] = false; }
                    });
                } else if (!shouldBeVisible && isVisible && !isAnimating[comp.id]) {
                    // Option to fade out when scrolling back up or past the end range
                    isAnimating[comp.id] = true;
                     anime({
                        targets: comp.id,
                        opacity: [1, 0],
                        translateY: [0, -10], // Example: slide out slightly
                        scale: [1, 0.9],
                        easing: 'easeInExpo',
                        duration: 400,
                        complete: () => { isAnimating[comp.id] = false; }
                    });
                }
            });
        };

        // Attach debounced scroll listener
        $(window).on('scroll', debounce(handleScrollAnimation, 50));
        handleScrollAnimation(); // Initial check on load
    }

    // --- Axios Example Placeholder ---
    // function fetchDataExample() {
    //   axios.get('/api/some-data') // Replace with your actual API endpoint if needed
    //     .then(response => {
    //       console.log("Data fetched:", response.data);
    //       // Update UI with data
    //     })
    //     .catch(error => {
    //       console.error("Error fetching data:", error);
    //     });
    // }
    // fetchDataExample(); // Call if needed

});