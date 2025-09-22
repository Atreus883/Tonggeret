document.addEventListener('DOMContentLoaded', function() {
    const starLabels = document.querySelectorAll('.star-rating label');
    const ratingValue = document.querySelector('.star-rating-value');
    const ratingInputs = document.querySelectorAll('.star-rating input');

    // Show initial rating if exists
    const checkedInput = document.querySelector('.star-rating input:checked');
    if (checkedInput) {
        ratingValue.textContent = `${checkedInput.value}/10`;
    }

    starLabels.forEach(label => {
        label.addEventListener('mouseover', function() {
            const rating = this.getAttribute('for').includes('-half') 
                ? (parseInt(this.getAttribute('for').replace('star', '').split('-')[0]) * 2) - 1
                : parseInt(this.getAttribute('for').replace('star', ''));
            ratingValue.textContent = `${rating}/10`;
        });
    });

    document.querySelector('.star-rating').addEventListener('mouseleave', function() {
        const checkedInput = document.querySelector('.star-rating input:checked');
        ratingValue.textContent = checkedInput ? `${checkedInput.value}/10` : '';
    });

    ratingInputs.forEach(input => {
        input.addEventListener('change', function() {
            ratingValue.textContent = `${this.value}/10`;
        });
    });
});
