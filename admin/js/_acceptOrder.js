const paymentStatus = document.querySelectorAll(".table-container .table-content .table-data .table table tr .payment-status");
const orderStatus = document.querySelectorAll(".table-container .table-content .table-data .table table tr .order-status");
const acceptBtn = document.querySelectorAll(".table-container .table-content .table-data .table table tr td .accept-order-btn");
const rejectBtn = document.querySelectorAll(".table-container .table-content .table-data .table table tr td .reject-order-btn");
const mailFormContainer = document.getElementById("mail-container");
const closeBtn = document.querySelector("#mail-container .form-box .form-heading #close-img");
const emailField = document.getElementById("email");
const subject = document.getElementById("subject");
const message = document.getElementById("message");
let operation = null;

const search = document.getElementById("empSearchBar");
const show = () => {
    let v = search.value.toUpperCase();
    let key = document.querySelectorAll(".table-data .table table tr .searchKey");
    key.forEach(element => {
        let keyValue = element.textContent.toUpperCase();
        // console.log(keyValue);
        // console.log(v);
        if (keyValue.indexOf(v) > -1)
            element.parentNode.style.display = "";
        else
            element.parentNode.style.display = "none";
    });

}
search.addEventListener("keyup", show);
window.onload = () => {
    search.focus();
}


acceptBtn.forEach(btn => {
    btn.addEventListener("click", (e) => {
        let emailValue = btn.parentNode.previousElementSibling.textContent;
        emailField.value = emailValue;
        mailFormContainer.style.display = "block";
        operation = "accept";
        subject.focus();
    })
})

rejectBtn.forEach(btn => {
    btn.onclick = (e) => {
        let emailValue = btn.parentNode.previousElementSibling.textContent;
        emailField.value = emailValue;
        mailFormContainer.style.display = "block";
        operation = "reject";
        subject.focus();
    }
})

closeBtn.addEventListener("click", (e) => {
    mailFormContainer.style.display = "none";
    document.getElementById("mail-form").reset();
    search.focus();
})

orderStatus.forEach((sts) => {
    if (sts.textContent == "cancel")
        sts.style.color = "red";
    else if (sts.textContent == "running")
        sts.style.color = "orange";
    else if (sts.textContent == "success")
        sts.style.color = "green";
    else
        sts.style.color = "blue";
})

paymentStatus.forEach(sts => {
    if (sts.textContent == "success")
        sts.style.color = "green";
    else if (sts.textContent == "failed")
        sts.style.color = "red";
})


const sendBtn = document.getElementById("send-btn");
sendBtn.addEventListener("click", (event) => {
    event.preventDefault();
    let formData = new FormData();
    formData.append("mail", emailField.value);
    formData.append("subject", subject.value);
    formData.append("message", message.value);
    formData.append("operation", operation);
    formData.append("sendMail", "Send given mail");

    let parameter = {
        header: {},
        method: "POST",
        body: formData
    }

    fetch("submittingFormData.php", parameter)
        .then(response => response.text())
        .then((data) => { alert(data); })
})