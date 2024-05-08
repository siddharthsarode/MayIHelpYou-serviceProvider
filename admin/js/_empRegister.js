//send service data to server using ajax
const submit = document.getElementById("submit");
const res = document.getElementById("response");
const sendData = (event) => {
    event.preventDefault();

    let name = document.getElementById("empName").value;
    let email = document.getElementById("empEmail").value;
    let mobile = document.getElementById("mobile").value;
    let adr = document.getElementById("empAddress").value;
    let age = document.getElementById("empAge").value;
    let pass = document.getElementById("empPassword").value;
    let category = document.getElementById("empCategory").value;
    let adharNo = document.getElementById("adharNo").value;
    let panNo = document.getElementById("panNo").value;
    let adharImg = document.getElementById("adharImage");
    let panImage = document.getElementById("panCardImage");
    let profile = document.getElementById("empProfile");
    let submit = "add Employee";

    let adharCard = adharImg.files[0];
    let panCard = panImage.files[0];
    let profilePicture = profile.files[0];

    console.log("function called");
    let formData = new FormData();

    console.log(adharCard);
    console.log(panCard);
    formData.append("empName", name);
    formData.append("empEmail", email);
    formData.append("mobile", mobile);
    formData.append("empAddress", adr);
    formData.append("age", age);
    formData.append("password", pass);
    formData.append("empCategory", category);
    formData.append("adharNo", adharNo);
    formData.append("panNo", panNo);
    formData.append("adharCard", adharCard);
    formData.append("panCard", panCard);
    formData.append("profile", profilePicture);
    formData.append("employeeRegistration", submit);

    let param = {
        "method": "POST",
        "header": {},
        "body": formData
    };

    fetch("submittingFormData.php", param)
        .then((response) => response.text())
        .then((data) => {
            // console.log("hello")
            console.log(data);
            res.innerHTML = data;
            if (data.includes("Employee Registered Successfully..!")) {
                document.getElementById("emp-registration-form").reset();
                res.style.color = "green";
            } else {
                res.style.color = "red";
            }
        })
        .catch((err) => res.innerHTML = err);

    setTimeout(() => {
        res.innerHTML = "";
    }, 5000);
}
window.onload = () => {
    empName.focus();
}
submit.addEventListener("click", sendData);
