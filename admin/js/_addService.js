//send service data to server using ajax
const submit = document.getElementById("submit");
const res = document.getElementById("response");
const sendData = (event) => {
    event.preventDefault();

    let serviceName = document.getElementById("serviceName").value;
    let description = document.getElementById("desc").value;
    let price = document.getElementById("servicePrice").value;
    let dur = document.getElementById("serviceDuration").value;
    let cat = document.getElementById("category").value;
    let img = document.getElementById("serviceImage");
    let submit = "Add Service";

    console.log("function called");
    let formData = new FormData();
    let file = img.files[0];

    console.log(file);
    formData.append("serviceName", serviceName)
    formData.append("desc", description)
    formData.append("servicePrice", price)
    formData.append("serviceDuration", dur)
    formData.append("cate_id", cat)
    formData.append("file", file);
    formData.append("service", submit);

    let param = {
        "method": "POST",
        "header": {},
        "body": formData
    };

    fetch('submittingFormData.php', param)
        .then((response) => response.text())
        .then((data) => {
            res.innerHTML = data;
            if (data.includes("Service added successfully..!")) {
                document.getElementById("add-service-form").reset();
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
