// resources/js/highlight.js
document.addEventListener('alpine:init', () => {
    Alpine.data('highlightOnLoad', () => ({
        init() {
            const urlParams = new URLSearchParams(window.location.search);
            const targetID = urlParams.get('category'); // This retrieves "2" from ?category=2
            console.log(targetID);
            if (targetID) {
                const targetElement = document.getElementById(targetID);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    targetElement.classList.add('animate-bg');
                }
            }
        }
    }));
});

document.addEventListener('alpine:init', () => {
    Alpine.data('highlightCategory', () => ({
        init() {
            const urlParams = new URLSearchParams(window.location.search);
            const targetID = urlParams.get('category'); // This retrieves "2" from ?category=2
            if (targetID) {
                const targetElement = document.getElementById(targetID);
                if (targetElement) {
                    targetElement.classList.remove('bg-black', 'text-white');
                    targetElement.classList.add('bg-white', 'text-black');

                }
            }
        }
    }));
});
