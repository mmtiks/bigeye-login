document.getElementById("username").focus();

function jsFunction(text) {
    let message = document.getElementById("message");
    message.style.display = "unset";
    message.innerHTML = text;
}