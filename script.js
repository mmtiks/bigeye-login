document.getElementById("username").focus();

function jsFunction(text) {
    let message = document.getElementById("message");
    message.style.display = "unset";
    message.innerHTML = text;
}

//https://www.w3resource.com/javascript/form/email-validation.php
function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.emailAddr.value))
  {
    return (true)
  }
    alert("You have entered an invalid email address!")
    return (false)
}