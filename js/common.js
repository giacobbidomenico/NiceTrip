"use strict";

/**
 * Function that requests the server if the email entered in the form corresponds to an existing account.
 * If does not happen, an error message is shown in the form.
 * 
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
            (response.data["num-"+type] > 0 &&  order)) {
            showFieldInvalid(field, message_error);
        } else if ((response.data["num-"+type] > 0 && !order) ||
            (response.data["num-"+type]  == 0 && order)) {
            showFieldValid(field);
        }
    });
}

function showIfEmptyField(field, valid=true) {
    if(field.value === '') {
        showFieldInvalid(field, field.name + ' is request!');
        return true;
    } else if(valid){
        showFieldValid(field);
    }
    return false;
}

function insertMessageError(field, message_error) {
    if(message_error !== '') {
        field.parentElement.getElementsByClassName("invalid-feedback")[0].innerHTML = '<p>' + message_error + '</p>';
    }
}

function showFieldInvalid(field, message_error='') {
    insertMessageError(field, message_error);

    field.classList.remove("is-valid");
    field.classList.add("is-invalid");
}

function showFieldValid(field, message_error='') {
    if(field.parentElement.getElementsByClassName("invalid-feedback").lenght == 0) {
        field.parentElement.innerHTML += '<div class="invalid-feedback"></div>';
    }

    insertMessageError(field, message_error);

    field.classList.remove("is-invalid");
    field.classList.add("is-valid");
}

/**
 * Function that makes the password field of the form visible if the user requests it.
 * 
 */
function viewPassword(field) {
    if(field.type === 'password') {
        field.type = 'text';
    } else {
        field.type = 'password';
    }
}

function disableAllFields(completeForm) {
    for (let item of completeForm.getElementsByTagName("input")) {
        item.disabled = true;
    }
}

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
