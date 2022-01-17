function validateName() {
    // [A-Za-z]{1,50}
    let label = document.getElementById("labelName");
    if(label.childElementCount>0) label.removeChild(label.childNodes[1]);
    let error_list = document.createElement("ul");
    let field_value = document.getElementById("name").value;
    // length
    if(field_value==0) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Campo nome vuoto!");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    // numbers
    if(/\d/.test(field_value)) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Numeri non consentiti nel nome");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    if(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(field_value)){
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Caratteri speciali non consentiti nel nome");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    label.appendChild(error_list);
}

function validateSurname() {
    // [A-Za-z]{1,50}
    let label = document.getElementById("labelSurname");
    if(label.childElementCount>0) label.removeChild(label.childNodes[1]);
    let error_list = document.createElement("ul");
    let field_value = document.getElementById("surname").value;
    // length
    if(field_value==0) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Campo vuoto!");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    // numbers
    if(/\d/.test(field_value)) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Numeri non consentiti nel cognome");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    // special char
    if(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(field_value)){
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Caratteri speciali non consentiti nel cognome");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    label.appendChild(error_list);
}

function validateUsername() {
    // ^[a-zA-Z][a-zA-Z0-9-_\.]{1,25}$
    let label = document.getElementById("labelUser");
    if(label.childElementCount>0) label.removeChild(label.childNodes[1]);
    let error_list = document.createElement("ul");
    let field_value = document.getElementById("username").value;
    // length
    if(field_value==0) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Campo vuoto!");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    // special char
    if(!/-_\./.test(field_value)){
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Gli unici caratteri speciali consentiti sono - _ .");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    label.appendChild(error_list);    
}

function validateYear() {
    // min 2008 max currentYear
    let label = document.getElementById("labelYear");
    if(label.childElementCount>0) label.removeChild(label.childNodes[1]);
    let error_list = document.createElement("ul");
    let field= document.getElementById("year");
    let min = field.getAttribute("min"); let max = field.getAttribute("max");
    if(field.value<min || field.value>max) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Inserire un anno compreso tra "+min+" e "+max);
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    label.appendChild(error_list);
}

function validatePassword() {
    // (?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$
    let label = document.getElementById("labelPass");
    if(label.childElementCount>0) label.removeChild(label.childNodes[1]);
    let error_list = document.createElement("ul");
    let field_value = document.getElementById("password").value;
    // length
    if(field_value==0) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Campo vuoto!");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    if(field_value<8) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Password troppo corta: minimo 8 caratteri!");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);

    }
    // Uppercase
    if(!/[A-Z]/.test(field_value)) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Aggiungere almeno una lettera maiuscola alla password");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    // lowercase
    if(!/[a-z]/.test(field_value)) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Aggiungere almeno una lettere minuscola password");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    // numbers
    if(!/\d/.test(field_value)) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Aggiungere almeno un numero alla password");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    // special char
    if(!/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(field_value)){
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Aggiungere almeno un carattere speciale alla password");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);
    }
    label.appendChild(error_list);    
}

function validateCPass() {
    let label = document.getElementById("labelCPass");
    if(label.childElementCount>1) label.removeChild(label.childNodes[2]);
    let error_list = document.createElement("ul");
    let field_value = document.getElementById("password").value;
    let control = document.getElementById("check_password").value;
    if(field_value!=control) {
        let list_item = document.createElement("li");
        let item_text = document.createTextNode("Le password non corrispondono!");
        list_item.appendChild(item_text);
        error_list.appendChild(list_item);        
    }
    label.appendChild(error_list);
}