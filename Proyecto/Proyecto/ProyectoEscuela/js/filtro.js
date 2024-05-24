document.querySelector('.toggle-button').addEventListener('click', function() {
    const formContainer = document.querySelector('.form-container');
    formContainer.style.display = formContainer.style.display === 'block' ? 'none' : 'block';
});
