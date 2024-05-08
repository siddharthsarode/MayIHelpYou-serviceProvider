const adminName = document.getElementById("adminName");
const email = document.getElementById("email");
const password = document.getElementById("password");
const signUpBtn = document.getElementById("admin-btn");

signUpBtn.addEventListener("click", (e) => {
    e.preventDefault();

    let formData = new FormData();

    formData.append("adminName", adminName.value);
    formData.append("adminEmail", email.value);
    formData.append("adminPassword", password.value);

    formData.append("admin-sign-up", "sign-up");

    let param = {
        method: "POST",
        header: {},
        body: formData
    }

    fetch("submittingFormData.php", param)
        .then(response => response.text())
        .then((data) => {
            alert(data);
            if (data.includes("Admin Registered Successfully..")) {
                document.getElementById("admin-sign-up-form").reset();
            }
        })
})