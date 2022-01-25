function get_review() {
    const textArea = document.getElementById("modify");
    let review = textArea.parentNode.previousElementSibling.innerText;
	textArea.textContent = review;
}