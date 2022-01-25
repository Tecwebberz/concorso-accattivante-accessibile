function removeErrorList(element, stdChild) {
    if(element.childElementCount>stdChild) element.removeChild(element.lastChild);
}

function appendError(error_list, list_item, item_text) {
    list_item.appendChild(item_text);
    error_list.appendChild(list_item);
}

function appendErrorList(error_flag, label, list) {
    if(error_flag) label.appendChild(list);
}

function checkLength(field_value, error_list, length) {
    let error_flag=false;
    const list_item = document.createElement("li");
    let item_text;
    if(field_value.length<length) {
        error_flag = true;
        item_text = document.createTextNode("Troppo corto: minimo "+length+" caratteri");
        if(field_value.length==0) item_text = document.createTextNode("Campo vuoto!");
        appendError(error_list, list_item, item_text);
    }
    return error_flag;
}

function checkNumbers(field_value, error_list, noNum) {
    let error_flag = false;
    const list_item = document.createElement("li");
    let item_text;
    if(noNum && /\d/.test(field_value)) {
        error_flag = true;
        item_text = document.createTextNode("Numeri non consentiti");
    }
    if(!noNum && !/\d/.test(field_value)) {
        error_flag = true;
        item_text = document.createTextNode("Deve contenere almeno un numero");
    }
    if(error_flag) appendError(error_list, list_item, item_text);
    return error_flag;
}

function checkSpecial(field_value, error_list, noSpec) {
    let error_flag = false;
    const list_item = document.createElement("li");
    let item_text;
    if(noSpec && /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(field_value)){
        error_flag = true;
        item_text = document.createTextNode("Caratteri speciali non consentiti");
    }
    if(!noSpec && !/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(field_value)){
        error_flag = true;
        item_text = document.createTextNode("Deve contenere almeno un carattere speciale");
    }
    if(error_flag) appendError(error_list, list_item, item_text);
    return error_flag;
}

function validateName() {
    // [A-Za-z]{1,50}
    const label = document.getElementById("labelName");
    removeErrorList(label, 0);
    const error_list = document.createElement("ul");
    error_list.classList.add("error");
    let error_flag = false;
    const field_value = document.getElementById("name").value.trim();
    error_flag = checkLength(field_value, error_list, 1) |
                 checkNumbers(field_value, error_list, true) |
                 checkSpecial(field_value, error_list, true);
    appendErrorList(error_flag, label, error_list);
}

function validateSurname() {
    // [A-Za-z]{1,50}
    const label = document.getElementById("labelSurname");
    removeErrorList(label, 0);
    const error_list = document.createElement("ul");
    error_list.classList.add("error");
    let error_flag = false;
    const field_value = document.getElementById("surname").value.trim();
    error_flag = checkLength(field_value, error_list, 1) | 
                 checkNumbers(field_value, error_list, true) |
                 checkSpecial(field_value, error_list, true);
    appendErrorList(error_flag, label, error_list);
}

function validateUsername() {
    // ^[a-zA-Z][a-zA-Z0-9-_\.]{1,25}$
    const label = document.getElementById("labelUser");
    removeErrorList(label, 0);
    const error_list = document.createElement("ul");
    error_list.classList.add("error");
    let error_flag = false;
    const field_value = document.getElementById("username").value.trim();
    error_flag = checkLength(field_value, error_list, 8);
    // special char
    if(!/^[a-zA-Z0-9-_\.]*$/.test(field_value)){
        error_flag = true;
        const list_item = document.createElement("li");
        const item_text = document.createTextNode("Gli unici caratteri speciali consentiti sono - _ .");
        appendError(error_list, list_item, item_text);
    }
    // Primo carattere
    if(field_value != 0 && !/^[a-zA-Z]/.test(field_value[0])){
        error_flag = true;
        const list_item = document.createElement("li");
        const item_text = document.createTextNode("Il primo carattere deve essere una lettera.");
        appendError(error_list, list_item, item_text);
    }
    appendErrorList(error_flag, label, error_list);
}

function validateYear() {
    // min 2008 max currentYear
    const label = document.getElementById("labelYear");
    removeErrorList(label, 0);
    const error_list = document.createElement("ul");
    error_list.classList.add("error");
    let error_flag = false;
    const field= document.getElementById("year");
    const min = field.getAttribute("min"); const max = field.getAttribute("max");
    if(field.value<min || field.value>max) {
        error_flag = true;
        const list_item = document.createElement("li");
        const item_text = document.createTextNode("Inserire un anno compreso tra "+min+" e "+max);
        appendError(error_list, list_item, item_text);
    }
    appendErrorList(error_flag, label, error_list);
}

function validatePassword() {
    // (?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$
    const label = document.getElementById("labelPass");
    removeErrorList(label, 0);
    const error_list = document.createElement("ul");
    error_list.classList.add("error");
    let error_flag = false;
    const field_value = document.getElementById("password").value.trim();
    error_flag = checkLength(field_value, error_list, 8) | 
                 checkNumbers(field_value, error_list, false) |
                 checkSpecial(field_value, error_list, false);
    // Uppercase
    if(!/[A-Z]/.test(field_value)) {
        error_flag = true;
        const list_item = document.createElement("li");
        const item_text = document.createTextNode("Deve contenere almeno una lettera maiuscola");
        appendError(error_list, list_item, item_text);
    }
    // lowercase
    if(!/[a-z]/.test(field_value)) {
        error_flag = true;
        const list_item = document.createElement("li");
        const item_text = document.createTextNode("Deve contenere almeno una lettera minuscola");
        appendError(error_list, list_item, item_text);
    }
    appendErrorList(error_flag, label, error_list);
    validateCPass();
}

function validateCPass() {
    const label = document.getElementById("labelCPass");
    removeErrorList(label, 1);
    const error_list = document.createElement("ul");
    error_list.classList.add("error");
    let error_flag = false;
    const field_value = document.getElementById("password").value.trim();
    const control = document.getElementById("check_password").value.trim();
    if(field_value!=control) {
        error_flag = true;
        const list_item = document.createElement("li");
        const item_text = document.createTextNode("Le password non corrispondono!");
        appendError(error_list, list_item, item_text);      
    }
    appendErrorList(error_flag, label, error_list);
}