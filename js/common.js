"use strict";

async function update() {
	axios.post('api-email-notifications.php');
}
setInterval(update, 5000);

/**
 * Function that takes care of request the server if the credentials entered, in a field of a form, 
 * correspond to a specific account.
 * 
 * @param {*} field
 *            considered field
 * @param {*} order
 *            order is true if an error message is returned if the credentials match an account, 
 *            false if a success message is to be returned
 * @param {*} type
 *            type determines what the type of credential is
 * @param {*} message_error
 *            message_error is the error message that is eventually returned
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function verifyAccount(field, order, type, message_error, tooltip) {
    const formData = new FormData();

    formData.append('type-request', 'verify-'+ type);
    formData.append(type, field.value);

    axios.post('api-authentication.php', formData).then(response => {
        if(response.data["error-verify-"+type] ||
            field.value === '' ||
            !field.checkValidity() ||
            (response.data["num-"+type] == 0 && !order) ||
            (response.data["num-"+type] > 0 && order)) {
            showFieldInvalid(field, message_error, tooltip);
        } else if ((response.data["num-"+type] > 0 && !order) ||
            (response.data["num-"+type]  == 0 && order)) {
            showFieldValid(field, '', tooltip);
        }
    });
}

/**
 * Function that takes care of removing the validation from a field.
 * 
 * @param {*} field
 *            considered field
 */
function showFieldWithoutValidation(field) {
    if(field.classList.contains("is-valid")) {
        field.classList.remove("is-valid");
    }

    if(field.classList.contains("is-invalid")) {
        field.classList.remove("is-invalid");
    }
}

/**
 * Function that shows an error message if a form field has not been filled in and returns true, 
 * otherwise if desired, prints a success message and returns false.
 * 
 * @param {*} field
 *            considered field
 * @param {*} valid
 *            valid is true if you want a success message to be returned if the field is not empty, false otherwise
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 * 
 * @returns true if the field is empty, false otherwise
 */
function showIfEmptyField(field, valid=true, tooltip) {
    console.log(tooltip);
    
    if(field.value === '') {
        showFieldInvalid(field, field.name + ' is request!', tooltip);
        return true;
    } else if(valid){
        showFieldValid(field, '', tooltip);
    }

    return false;
}

/**
 * Function that displays an error message in all fields of a form that have not been filled in.
 * 
 * @param {*} completeForm
 *            considered form
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function showEmptyFields(completeForm, tooltip) {
    for(let item of completeForm.querySelectorAll("[required]")) {
        if(!item.classList.contains("is-invalid") && item.type !== 'checkbox' && item.type !== 'submit') {
            showIfEmptyField(item, true, tooltip);
        }
    }
}

/**
 * Function that inserts a new message below a field.
 * 
 * @param {*} field
 *            considered field
 * @param {*} message_error
 *            error message that is displayed
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function insertMessage(field, message_error, tooltip) {
    console.log(tooltip);
    if(message_error !== '') {
        if(!tooltip) {
            field.parentElement.getElementsByClassName("invalid-feedback")[0].innerHTML = '<p>' + message_error + '</p>';
        }else {
            field.parentElement.getElementsByClassName("invalid-tooltip")[0].innerHTML = '<p>' + message_error + '</p>';
        }
    }
}

/**
 * Function that displays an error message corresponding to a field.
 * 
 * @param {*} field
 *            considered field
 * @param {*} message_error
 *            error message that is displayed
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function showFieldInvalid(field, message_error='', tooltip) {
    insertMessage(field, message_error, tooltip);

    field.classList.remove("is-valid");
    field.classList.add("is-invalid");
}

/**
 * Function that displays a success message corresponding to a field.
 * 
 * @param {*} field
 *            considered field 
 * @param {*} message
 *            message that is displayed
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function showFieldValid(field, message='', tooltip) {
    if(!tooltip) {
        if(field.parentElement.getElementsByClassName("invalid-feedback").lenght == 0) {
            field.parentElement.innerHTML += '<div class="invalid-feedback"></div>';
        }
    }else {
        if(field.parentElement.getElementsByClassName("invalid-tooltip").lenght == 0) {
            field.parentElement.innerHTML += '<div class="invalid-tooltip"></div>';
        }
    }
    

    insertMessage(field, message, tooltip);

    field.classList.remove("is-invalid");
    field.classList.add("is-valid");
}

/**
 * Function that makes the password field visible if the user requests it.
 * 
 * @param {*} field
 *            considered field
 */
function viewPassword(field) {
    if(field.type === 'password') {
        field.type = 'text';
    } else {
        field.type = 'password';
    }
}

/**
 * Function that disables all the fields of a form.
 * 
 * @param {*} completeForm
 *            considered form
 */
function disableAllFields(completeForm) {
    for (let item of completeForm.getElementsByTagName("input")) {
        item.disabled = true;
    }
}

/**
 * Function that displays a message on the form.
 * 
 * @param {*} message
 *            message that will be shown 
 * @param {*} type
 *            message type
 */
function showMessage(elementMessage, message, type) {
    elementMessage.classList = '';
    elementMessage.classList.add("fw-bold");
    if(type==='error') {
        elementMessage.classList.add('text-danger');
    } else {
        elementMessage.classList.add('text-success');
        disableAllFields(form);
    }
    elementMessage.innerText = message;
}

/**
 * Function that checks if the password is secure.
 * If it is, the field is validated, otherwise an error message is shown.
 * 
 * @param {*} field
 *            considered field
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function checkPasswordStrength(field, tooltip) {
    if(showIfEmptyField(field, true, tooltip)) {
        return;
    }
    const strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    if(!strongRegex.test(field.value)) {
        showFieldInvalid(field,'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character', tooltip);
    } else {
        showFieldValid(field, '', tooltip);
    }
}

/**
 * Function that checks if the confirmation password field value is equal to
 * that of the password field. If so, the password confirmation field is validated, 
 * otherwise an error message is returned.
 * 
 * @param {*} p_field
 *            password field
 * @param {*} field
 *            confirmation password field
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function checkPasswordConfirmation(p_field, field, tooltip) {
    if(showIfEmptyField(field, true, tooltip)) {
        return;
    }
    if(p_field.value === field.value) {
        showFieldValid(field, '', tooltip);
    } else {
        showFieldInvalid(field, 'password does not match!', tooltip);
    }
}

/**
 * Function that deals with the management of a field of a form containing an e-mail.
 * 
 * @param {*} field
 *            considered field
 * @param {*} order
 *            order is true if an error message is returned if the e-mail match an account,
 *            false if a success message is to be returned
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function verifyEmail(field, order, tooltip) {
    if(showIfEmptyField(field, true, tooltip)) {
        return;
    }

    //Check the format of the email
    if(!field.checkValidity()) {
        showFieldInvalid(field, "invalid email format!",tooltip);
        return;
    }

    verifyAccount(field, order, 'email', 'email is already used!', tooltip);
}

/**
 * Function that deals with the management of a field of a form containing an username.
 * 
 * @param {*} field
 *            considered field
 * @param {*} order
 *            order is true if an error message is returned if the username match an account,
 *            false if a success message is to be returned
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function verifyUsername(field, order, tooltip) {
    if(showIfEmptyField(field, true, tooltip)) {
        return;
    }
    verifyAccount(field, order, 'username', 'username is already used!', tooltip);
    showIfEmptyField(field, true, tooltip);
}

/**
 * Function that deals with the management of a field of a form containing an email or a username.
 * 
 * @param {*} field
 *            considered field
 * @param {*} order
 *            order is true if an error message is returned if the email/username match an account,
 *            false if a success message is to be returned
 * @param {*} tooltip
 *            true if a tooltip is to be used, false otherwise
 */
function verifyEmailOrUsername(field, order, tooltip) {
    if(showIfEmptyField(field, true, tooltip)) {
        return;
    }
    verifyAccount(field, order, "email-username", "no matching accounts", tooltip);
}