function cancelModify(review) {
    review.children[1].classList.add("vote");
    review.children[1].hidden = false;
    review.children[2].hidden = false;
    review.children[3].classList.add("modify");
    review.children[3].hidden = false;
    const btnClass = ["btn", "btn-primary", "btn-mini", "btn-modify"];
    review.children[3].children[0].classList.add(btnClass[0],btnClass[1],btnClass[2],btnClass[3]);
    review.children[3].children[1].classList.add(btnClass[0],btnClass[1],btnClass[2]);
    review.removeChild(review.children[4]);
}

function addStarLabel(star, num) {
    const label = document.createElement("label");
    label.htmlFor = "star"+star;
    label.appendChild(document.createTextNode(num+(star==1 ? " stella" : " stelle")));
    return label;
}

function addStarInput(star,actual_stars) {
    const input = document.createElement("input");
    input.type = "radio";
    input.id = "star-"+star;
    input.name = "rating";
    input.value = star;
    if(star==actual_stars) input.checked = true; 
    return input;
}

function modifyStars(actual_stars) {
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
        span.appendChild(addStarLabel(i, Numeri[i]));
        span.appendChild(addStarInput(i, actual_stars));
        span.appendChild(document.createElement("i"));
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
    const cancelText = document.createTextNode("Cancella");
    cancel.appendChild(cancelText);
    cancel.addEventListener('click', () => cancelModify(review));
    row.appendChild(cancel);
    return row;
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
    const form = document.createElement("form");
    form.classList.add("medium", "articled", "solid", "modify");
    form.action = "app/review.php";
    form.method = "POST";
    // Stars
    const stars = modifyStars(parseInt(review.dataset.stars));
    form.appendChild(stars);
    // Textarea
    const textareaLabel = document.createElement("label");
    textareaLabel.htmlFor = "review";
    textareaLabel.innerText= "Modifica la recensione";
    const textarea = document.createElement("textarea");
    textarea.name = "review";
    textarea.id = "review";
    textarea.rows =  4;
    textarea.textContent = review.children[2].innerText;
    form.appendChild(textareaLabel);
    form.appendChild(textarea);

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
