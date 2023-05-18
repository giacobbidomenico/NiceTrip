"use strict";

/**
 * Function that takes care of request the server if the credentials entered, in a field of a form, 
 * correspond to a specific account.
 * 
 * @param {*} field
 *            field considered
 * @param {*} order
 *            order is true if an error message is returned if the credentials match an account, 
 *            false if a success message is to be returned
 * @param {*} type
 *            type determines what the type of credential is
 * @param {*} message_error
 *            message_error is the error message that is eventually returned
 */
function verifyAccount(field, order, type, message_error) {
    const formData = new FormData();

    formData.append('type-request', 'verify-'+ type);
    formData.append(type, field.value);

    axios.post('api-authentication.php', formData).then(response => {
        if(response.data["error-verify-"+type] ||
            field.value === '' ||
            !field.checkValidity() ||
            (response.data["num-"+type] == 0 && !order) ||
            (response.data["num-"+type] > 0 && order)) {
            showFieldInvalid(field, message_error);
        } else if ((response.data["num-"+type] > 0 && !order) ||
            (response.data["num-"+type]  == 0 && order)) {
            showFieldValid(field);
        }
    });
}

/**
 * Function that shows an error message if a form field has not been filled in and returns true, 
 * otherwise if desired, prints a success message and returns false
 * 
 * @param {*} field
 *            field considered
 * @param {*} valid
 *            valid is true if you want a success message to be returned if the field is not empty, false otherwise
 * 
 * @returns true if the field is empty, false otherwise
 */
function showIfEmptyField(field, valid=true) {
    if(field.value === '') {
        showFieldInvalid(field, field.name + ' is request!');
        return true;
    } else if(valid){
        showFieldValid(field);
    }
    return false;
}

/**
 * Function that inserts a new message below a field
 * 
 * @param {*} field
 *            field considered
 * @param {*} message_error
 *            error message that is displayed
 */
function insertMessage(field, message_error) {
    if(message_error !== '') {
        field.parentElement.getElementsByClassName("invalid-feedback")[0].innerHTML = '<p>' + message_error + '</p>';
    }
}

/**
 * Function that displays an error message corresponding to a field.
 * 
 * @param {*} field
 *            field considered
 * @param {*} message_error
 *            error message that is displayed
 */
function showFieldInvalid(field, message_error='') {
    insertMessage(field, message_error);

    field.classList.remove("is-valid");
    field.classList.add("is-invalid");
}

/**
 * Function that displays a success message corresponding to a field.
 * 
 * @param {*} field
 *            field considered 
 * @param {*} message
 *            message that is displayed
 */
function showFieldValid(field, message='') {
    if(field.parentElement.getElementsByClassName("invalid-feedback").lenght == 0) {
        field.parentElement.innerHTML += '<div class="invalid-feedback"></div>';
    }

    insertMessage(field, message);

    field.classList.remove("is-invalid");
    field.classList.add("is-valid");
}

/**
 * Function that makes the password field visible if the user requests it.
 * 
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
 *            form considered 
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
function showMessage(message, type) {
    const elementMessage = document.getElementById("message");
    elementMessage.classList = '';
    if(type==='error') {
        elementMessage.classList.add('text-danger');
    } else {
        elementMessage.classList.add('text-success');
        disableAllFields(form);
    }
    elementMessage.innerText = message;
}
