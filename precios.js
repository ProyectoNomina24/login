document.querySelectorAll('.accordion-button').forEach(button => {
    button.addEventListener('click', function() {
        const accordionContent = this.nextElementSibling;
        if (accordionContent.style.maxHeight) {
            accordionContent.style.maxHeight = null;
            this.classList.remove('active');
        } else {
            document.querySelectorAll('.accordion-content').forEach(content => {
                content.style.maxHeight = null;
            });
            document.querySelectorAll('.accordion-button').forEach(btn => {
                btn.classList.remove('active');
            });
            accordionContent.style.maxHeight = accordionContent.scrollHeight + 'px';
            this.classList.add('active');
        }
    });
});
