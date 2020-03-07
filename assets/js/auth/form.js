// Executes the following code when the DOM content has been loaded
document.addEventListener('DOMContentLoaded', function() {

    if (document.forms['authSignup']) {
        // On authSignup form submit
        document.forms['authSignup'].addEventListener('submit', function(e) {
            // It prevents the form being submitted if there are any errors
            e.preventDefault();

            // Defines the error array
            const hasErrors = [];

            // Here lies all the regex used for this form
            const isValidEmail = /[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;
            const isValidPassword = /^(?=.+[a-z])(?=.+[A-Z])(?=.+[!@#\$%\^&\*])(?=.+\d)\S{8,}$/;
            const isValidString = /^[\wÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'’\s-]+$/i;

            // Here lies all the elements used for the form
            const email = document.getElementById('email');
            const lastname = document.getElementById('lastname');
            const firstname = document.getElementById('firstname');
            const password = document.getElementById('password');
            const confirmation = document.getElementById('confirmation');

            // Here lies all the elements used to show errors to the user
            const emailError = email.nextElementSibling;
            const lastnameError = lastname.nextElementSibling;
            const firstnameError = firstname.nextElementSibling;
            const passwordError = password.nextElementSibling;
            const confirmationError = confirmation.nextElementSibling;

            // If the value is not empty and not valid
            if (isValidEmail.test(email.value) === false && email.value !== '') {
                emailError.textContent = 'L\'email n\'est pas valide.';
                emailError.style.display = 'inline';
                hasErrors[0] = true;
            } else if (email.value === '') {
                // If the value is empty
                emailError.textContent = 'L\'email est requis.';
                emailError.style.display = 'inline';
                hasErrors[0] = true;
            } else {
                // If the value is valid
                emailError.textContent = '';
                emailError.style.display = 'none';
                hasErrors[0] = false;
            }

            if (isValidString.test(lastname.value) === false && lastname.value !== '') {
                lastnameError.textContent = 'Le nom n\'est pas valide.';
                lastnameError.style.display = 'inline';
                hasErrors[1] = true;
            } else if (lastname.value === '') {
                lastnameError.textContent = 'Le nom est requis.';
                lastnameError.style.display = 'inline';
                hasErrors[1] = true;
            } else {
                lastnameError.textContent = '';
                lastnameError.style.display = 'none';
                hasErrors[1] = false;
            }

            if (isValidString.test(firstname.value) === false && firstname.value !== '') {
                firstnameError.textContent = 'Le prénom n\'est pas valide.';
                firstnameError.style.display = 'inline';
                hasErrors[2] = true;
            } else if (firstname.value === '') {
                firstnameError.textContent = 'Le prénom est requis.';
                firstnameError.style.display = 'inline';
                hasErrors[2] = true;
            } else {
                firstnameError.textContent = '';
                firstnameError.style.display = 'none';
                hasErrors[2] = false;
            }

            if (isValidPassword.test(password.value) === false && password.value !== '') {
                passwordError.textContent = 'Le mot de passe n\'est pas assez robuste.';
                passwordError.style.display = 'inline';
                hasErrors[3] = true;
            } else if (password.value === '') {
                passwordError.textContent = 'Le mot de passe est requis.';
                passwordError.style.display = 'inline';
                hasErrors[3] = true;
            } else {
                passwordError.textContent = '';
                passwordError.style.display = 'none';
                hasErrors[3] = false;
            }

            if (password.value !== confirmation.value) {
                confirmationError.textContent = 'Les mots de passe ne sont pas identiques.';
                confirmationError.style.display = 'inline';
                hasErrors[4] = true;
            } else if (confirmation.value === '') {
                confirmationError.textContent = 'Le mot de passe de confirmation est requis.';
                confirmationError.style.display = 'inline';
                hasErrors[4] = true;
            } else {
                confirmationError.textContent = '';
                confirmationError.style.display = 'none';
                hasErrors[4] = false;
            }

            // If there aren't any errors
            if (!hasErrors.includes(true)) {
                document.forms['authSignup'].submit();
            }
        });
    }

    if (document.forms['authLogin']) {
        document.forms['authLogin'].addEventListener('submit', function(e) {
            // It prevents the form being submitted if there are any errors
            e.preventDefault();

            // Defines the error array
            const hasErrors = [];

            // Here lies all the regex used for this form
            const isValidEmail = /[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;

            // Here lies all the elements used for the form
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            // Here lies all the elements used to show errors to the user
            const emailError = email.nextElementSibling;
            const passwordError = password.nextElementSibling;

            // If the value is not empty and not valid
            if (isValidEmail.test(email.value) === false && email.value !== '') {
                emailError.textContent = 'L\'email n\'est pas valide.';
                emailError.style.display = 'inline';
                hasErrors[0] = true;
            } else if (email.value === '') {
                // If the value is empty
                emailError.textContent = 'L\'email est requis.';
                emailError.style.display = 'inline';
                hasErrors[0] = true;
            } else {
                // If the value is valid
                emailError.textContent = '';
                emailError.style.display = 'none';
                hasErrors[0] = false;
            }

            if (password.value === '') {
                passwordError.textContent = 'Le mot de passe est requis.';
                passwordError.style.display = 'inline';
                hasErrors[1] = true;
            } else {
                passwordError.textContent = '';
                passwordError.style.display = 'none';
                hasErrors[1] = false;
            }

            if (!hasErrors.includes(true)) {
                document.forms['authLogin'].submit();
            }
        });
    }
});