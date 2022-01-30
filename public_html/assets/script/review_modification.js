function cancelModify(review) {
    review.children[1].classList.add("vote");
    review.children[1].hidden = false;
    review.children[2].hidden = false;
    review.children[3].hidden = false;
    const btnClass = ["btn", "btn-primary", "btn-mini", "btn-modify"];
    review.children[3].children[0].classList.add(btnClass[0],btnClass[1],btnClass[2],btnClass[3]);
    review.children[3].children[1].classList.add(btnClass[0],btnClass[1],btnClass[2]);
    review.removeChild(review.children[4]);
}

function addStarLabel(star, num, activeMod) {
    const label = document.createElement("label");
    label.htmlFor = "starM-"+star+"-"+activeMod;
    label.appendChild(document.createTextNode(num+(star==1 ? " stella" : " stelle")));
    return label;
}

function addStarInput(star, actualStars, activeMod) {
    const input = document.createElement("input");
    input.type = "radio";
    input.id = "starM-"+star+"-"+activeMod;
    input.name = "rating";
    input.value = star;
    if(star==actualStars) input.checked = true; 
    return input;
}

function modifyStars(actualStars, activeMod) {
    const fieldset = document.createElement("fieldset");
    fieldset.classList.add("rating", "row");
    const legend = document.createElement("legend");
    legend.innerText = "Voto";
    const span = document.createElement("span");
    span.classList.add("stars");
    const Numeri = {
        1: 'Una',
        2: 'Due',
        3: 'Tre',
        4: 'Quattro',
        5: 'Cinque'
    }; 
    for(let i=1; i<=5; i++) {
        span.appendChild(addStarLabel(i, Numeri[i], activeMod));
        span.appendChild(addStarInput(i, actualStars, activeMod));
        let starIcon = document.createElement("i");
        starIcon.setAttribute("aria-disable", true);
        span.appendChild(starIcon);
    }
    fieldset.appendChild(legend);
    fieldset.appendChild(span);
    return fieldset;
}

function createButton(tag) {
    const button = document.createElement(tag)
    button.classList.add("btn", "btn-primary", "col");
    return button;
}

function addButtons(review) {
    const row = document.createElement("div");
    row.classList.add("row");
    // Input button
    const input = createButton("input");
    input.type = "submit";
    input.value = "Modifica";
    row.appendChild(input);
    // Cancel button
    const cancel = createButton("button");
    const cancelText = document.createTextNode("Annulla");
    cancel.appendChild(cancelText);
    cancel.addEventListener('click', () => cancelModify(review));
    row.appendChild(cancel);
    return row;
}

function createTextareaLabel(activeMod) {
    const textareaLabel = document.createElement("label");
    textareaLabel.innerText= "Modifica la recensione";
    textareaLabel.htmlFor = "reviewM-"+activeMod;
    return textareaLabel;
}

function createTextarea(review, activeMod) {
    const textarea = document.createElement("textarea");
    textarea.id = "reviewM-"+activeMod;
    textarea.name = "review";
    textarea.rows = 4;
    textarea.cols = 80;
    textarea.textContent = review.children[2].innerText;
    return textarea;
}

function hideReview(review) {
    review.children[3].children[1].removeAttribute("class");
    review.children[3].children[0].removeAttribute("class");
    review.children[3].children[1].hidden = true;
    review.children[3].children[0].hidden = true;
    review.children[3].hidden = true;
    review.children[2].hidden = true;
    review.children[1].removeAttribute("class");
    review.children[1].hidden = true;
}

function enable_modify(review) {
    const activeMod = document.getElementsByClassName("modify").length;
    const form = document.createElement("form");
    form.classList.add("medium", "articled", "solid", "modify");
    form.action = "app/review.php";
    form.method = "POST";
    // Stars
    const stars = modifyStars(parseInt(review.dataset.stars), activeMod);
    form.appendChild(stars);
    // Textarea
    form.appendChild(createTextareaLabel(activeMod));
    form.appendChild(createTextarea(review, activeMod));
    // Hidden data
    const id_comm = document.createElement("input")
    id_comm.type = "hidden";
    id_comm.name = "id_comm";
    id_comm.value = review.dataset.id;
    form.appendChild(id_comm);

    const id = document.createElement("input")
    id.type = "hidden";
    id.name = "id";
    const urlParams = new URLSearchParams(window.location.search);
    id.value = urlParams.get("id");
    form.appendChild(id);

    const type = document.createElement("input")
    type.type = "hidden";
    type.name = "type";
    type.value = review.dataset.type;
    form.appendChild(type);

    // Buttons
    form.appendChild(addButtons(review));
    // Hide review
    hideReview(review);
    // Append form
    review.appendChild(form);
}

const buttons = document.getElementsByClassName("btn-modify");
Array.from(buttons).forEach(button => {
    const review = button.parentNode.parentNode;
    button.addEventListener('click', () => enable_modify(review));
});
