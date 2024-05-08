//send service data to server using ajax
const submit = document.getElementById("submit");
const res = document.getElementById("response");
const sendData = (event) => {
    event.preventDefault();

    let cateName = document.getElementById("serviceName").value;
    let category = "Add category";
    let data = new FormData();

    data.append("cateName", cateName);
    data.append("category", category);

    let param = {
        "method": "POST",
        "header": {},
        "body": data
    };

    fetch('submittingFormData.php', param)
        .then((response) => response.text())
        .then((data) => {
            res.innerHTML = data;
            if (data.includes("Category added successfully..!")) {
                document.getElementById("add-category-form").reset();
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
    serviceName.focus();
}
submit.addEventListener("click", sendData);

