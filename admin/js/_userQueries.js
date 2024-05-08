const searchBar = document.getElementById("userSearchBar");
const searchKey = document.querySelectorAll(".table-container .table-content .table-data .table table tr .searchUserName");

searchBar.addEventListener("keyup", (e) => {
    let searchValue = searchBar.value.toUpperCase();
    searchKey.forEach(key => {
        let keyValue = key.textContent.toUpperCase();
        if (keyValue.indexOf(searchValue) > -1)
            key.parentNode.style.display = "";
        else
            key.parentNode.style.display = "none";
    })
})

window.onload = () => {
    searchBar.focus();
}


//change color according to status
const statusArray = document.querySelectorAll(".table-container .table-content .table-data .table table tr .contactStatus");
statusArray.forEach(sts => {
    let text = sts.textContent.toUpperCase();
    if (text == "PENDING")
        sts.style.color = "blue";
    else if (text == "REPLIED")
        sts.style.color = "green";
})


//display email form container
const replyBtn = document.querySelectorAll(".table-container .table-content .table-data .table table tr .reply-btn");
const displayContent = document.getElementById("mail-container");
const sendBtn = document.getElementById("send-btn");
const email = document.getElementById("email");
const subject = document.getElementById("subject");
const message = document.getElementById("message");
replyBtn.forEach(btn => {
    btn.addEventListener("click", (e) => {
        displayContent.style.display = "block";
        let parent = btn.parentElement.parentElement.children[1];
        email.value = parent.textContent;
    })
})

const closeEmailForm = document.getElementById("close-img");
closeEmailForm.addEventListener("click", (e) => {
    displayContent.style.display = "none";
    document.getElementById("mail-form").reset();
})


sendBtn.addEventListener("click", (e) => {
    e.preventDefault();
    let formData = new FormData();
    formData.append("userQueryEmail", email.value);
    formData.append("userQuerySubject", subject.value);
    formData.append("userQueryMessage", message.value);
    formData.append("userQuery", "data");

    let param = {
        method: "POST",
        header: {},
        body: formData
    };

    fetch("submittingFormData.php", param)
        .then(response => response.text())
        .then((data) => {
            alert(data);
            if (data.includes("Mail Send Successfully..")) {
                document.getElementById("mail-form").reset();
            }
        })
})
