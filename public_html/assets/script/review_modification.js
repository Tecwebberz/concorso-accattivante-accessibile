function cancelModify(review) {
    review.children[1].classList.add("vote");
    review.children[1].hidden = false;
    review.children[2].hidden = false;
    review.children[3].classList.add("modify");
    review.children[3].hidden = false;
    review.removeChild(review.children[4]);
}

function addStarLabel(star) {
    const label = document.createElement("label");
    label.setAttribute("for", "star"+star);
    return label;
}

function addStarInput(star,actual_stars) {
    const input = document.createElement("input");
    input.setAttribute("type", "radio");
    input.setAttribute("id", "star-"+star);
    input.setAttribute("name", "rating");
    input.setAttribute("value", star);
    if(star==actual_stars) input.checked = true; 
    return input;
}

function modifyStars(actual_stars) {
    const fieldset = document.createElement("fieldset");
    fieldset.classList.add("rating");
    const legend = document.createElement("legend");
    legend.innerText = "Voto";
    const span = document.createElement("span");
    span.classList.add("stars");
    for(let i=1; i<=5; i++) {
        span.appendChild(addStarLabel(i));
        span.appendChild(addStarInput(i, actual_stars));
        span.appendChild(document.createElement("i"));
    }
    fieldset.appendChild(legend);
    fieldset.appendChild(span);
    return fieldset;
}

function addButtons(review) {
    const row = document.createElement("div");
    row.classList.add("row");
    // Input button
    const input = document.createElement("input");
    input.classList.add("btn");
    input.classList.add("btn-primary");
    input.classList.add("col");
    input.setAttribute("type", "submit");
    input.setAttribute("value", "Modifica");
    row.appendChild(input);
    // Cancel button
    const cancel = document.createElement("input");
    cancel.classList.add("btn");
    cancel.classList.add("btn-primary");
    cancel.classList.add("col");
    cancel.setAttribute("type", "button");
    cancel.setAttribute("value", "Annulla");
    cancel.addEventListener('click', () => cancelModify(review));
    row.appendChild(cancel);
    return row;
}

function enable_modify(review) {
    const form = document.createElement("form");
    form.classList.add("medium");
    form.classList.add("articled");
    form.classList.add("solid");
    form.classList.add("modify-review");
    form.action = "app/review.php";
    form.method = "POST";
    // Stars
    const stars = modifyStars(parseInt(review.dataset.stars));
    form.appendChild(stars);
    // Textarea
    const textareaLabel = document.createElement("label");
    textareaLabel.setAttribute("for", "review");
    textareaLabel.innerText= "Modifica la recensione";
    const textarea = document.createElement("textarea");
    textarea.setAttribute("name", "review");
    textarea.setAttribute("id", "review");
    textarea.setAttribute("rows", 4);
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
    review.children[3].removeAttribute("class");
    review.children[3].hidden = true;
    review.children[2].hidden = true;
    review.children[1].removeAttribute("class");
    review.children[1].hidden = true;
    // Append form
    review.appendChild(form);
}

const buttons = document.getElementsByClassName("btn-modify");
Array.from(buttons).forEach(button => {
    const review = button.parentNode.parentNode;
    button.addEventListener('click', () => enable_modify(review));
});
