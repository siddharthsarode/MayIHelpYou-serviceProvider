const searchBar = document.getElementById("search-input");
const searchElement = document.querySelectorAll("#table .content .table-box table tr .searchServiceName");
const closeBtn = document.getElementById("close-table-btn");
const displayBtn = document.getElementById("display-btn");
const table = document.getElementById("table");
const sendBtn = document.querySelectorAll("#table .content .table-box table tr .empId button");



const formServiceId = document.getElementById("serviceId");
const serviceName = document.getElementById("serviceName");
const desc = document.getElementById("desc");
const newDuration = document.getElementById("serviceDuration");
const serviceDuration = document.getElementById("duration");
const newCategory = document.getElementById("newCategory");
const category = document.getElementById("categoryId");
const servicePrice = document.getElementById("servicePrice");
const newServiceImg = document.getElementById("serviceImage");
const imgPath = document.getElementById("img-path");
const OldAvailability = document.getElementById("oldAvailability");
const newAvailability = document.getElementById("availability");
const updateBtn = document.getElementById("submit");




searchBar.addEventListener("keyup", (e) => {
    let searchValue = searchBar.value.toUpperCase();
    searchElement.forEach(element => {
        let elementValue = element.textContent.toUpperCase();
        if (elementValue.indexOf(searchValue) > -1)
            element.parentNode.style.display = "";
        else
            element.parentNode.style.display = "none";
    })
})

closeBtn.addEventListener("click", (e) => {
    table.style.display = "none";
    serviceName.focus();
})

displayBtn.addEventListener("click", (e) => {
    table.style.display = "block";
    searchBar.focus();
})


sendBtn.forEach(btn => {
    btn.addEventListener("click", (e) => {
        let serviceId = btn.parentNode.previousElementSibling.textContent;
        let send = "service_fetch_request";

        let formData = new FormData();

        formData.append("serviceId", serviceId);
        formData.append("service_fetch_request", send);

        let param = {
            method: "POST",
            header: {},
            body: formData
        }

        fetch("submittingFormData.php", param)
            .then(response => response.json())
            .then((data) => {
                // console.log(data);
                // console.log(data.service_cate_id);
                serviceName.value = data.service_name;
                desc.value = data.description;
                serviceDuration.value = data.avg_duration;
                category.value = data.service_cate_id;
                imgPath.value = data.image_path;
                servicePrice.value = data.price;
                OldAvailability.value = data.availability;
                formServiceId.value = data.service_id;

                table.style.display = "none";
                serviceName.focus();
            })
    })
})


updateBtn.addEventListener("click", (e) => {
    e.preventDefault();
    let formData = new FormData();
    formData.append("serviceName", serviceName.value);
    formData.append("description", desc.value);
    formData.append("oldDuration", serviceDuration.value);
    formData.append("newDuration", newDuration.value);
    formData.append("oldCategory", category.value);
    formData.append("newCategory", newCategory.value);
    formData.append("servicePrice", servicePrice.value);
    formData.append("oldImg", imgPath.value);
    formData.append("oldAvailable", OldAvailability.value);
    formData.append("newAvailability", newAvailability.value);
    formData.append("serviceId", formServiceId.value);

    let file = newServiceImg.files[0];
    formData.append("file", file);

    formData.append("updateService", "service info");

    let param = {
        method: "POST",
        header: {},
        body: formData
    }
    console.log("near");
    fetch("submittingFormData.php", param)
        .then(response => response.text())
        .then((data) => {
            alert(data);
            if (data.includes("Record Updated Successfully..")) {
                document.getElementById("update-service-form").reset();
            }
        })
})