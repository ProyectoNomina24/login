document.querySelectorAll('#accordion .link').forEach(button => {
  button.addEventListener('click', () => {
    const submenu = button.nextElementSibling;
    const arrow = button.querySelector('.fa-chevron-down');

    button.classList.toggle('open');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    arrow.classList.toggle('rotate');

    document.querySelectorAll('#accordion .link').forEach(otherButton => {
      if (otherButton !== button && otherButton.classList.contains('open')) {
        otherButton.classList.remove('open');
        otherButton.nextElementSibling.style.display = 'none';
        otherButton.querySelector('.fa-chevron-down').classList.remove('rotate');
      }
    });
  });
});