// This file can be extended with client-side functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Product Display App loaded');
    
    // Example of extending functionality:
    // Add click handlers for interactive elements
    const filterForm = document.querySelector('.filter-form');
    if (filterForm) {
        const resetButton = filterForm.querySelector('.btn-reset');
        if (resetButton) {
            resetButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = window.location.pathname;
            });
        }
    }
});
