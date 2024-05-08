// const updateBtnList=document.getElementById("update-btn").parentNode.parentNode.firstElementChild.textContent;
const updateBtnList = document.querySelectorAll(".table-container .table-content .table-data .table table tr td .update");
const formContainer = document.getElementById("update-category");
const closeBtn = document.getElementById("close-img");
const cateNameField = document.getElementById("categoryName");
const submitBtn = document.getElementById("submit");
const searchBar = document.querySelector(".table-container .table-content .header #cateSearchBar");
const searchKey = document.querySelectorAll(".table-container .table-content .table table tr .searchValue");
let cateId = null;
updateBtnList.forEach(btn => {
    btn.addEventListener("click", (e) => {
        // console.log("clicked");
        formContainer.style.display = "block";
        let currentCategory = btn.parentNode.parentNode.firstElementChild.textContent;
        cateId = btn.parentNode.previousElementSibling.textContent;
        cateNameField.value = currentCategory;
    })
})

closeBtn.addEventListener("click", (e) => {
    formContainer.style.display = "none";
})

searchBar.addEventListener("keyup", (e) => {
    searchKey.forEach(keyElement => {
        let cmpValue = keyElement.textContent.toUpperCase();
        let searchData = searchBar.value.toUpperCase();
        if (cmpValue.indexOf(searchData) > -1) {
            keyElement.parentNode.style.display = "";
        } else {
            keyElement.parentNode.style.display = "none";
        }
    })
})

window.onload = () => {
    searchBar.focus();
}

submitBtn.addEventListener("click", (event) => {
    event.preventDefault();

    let formData = new FormData();
    formData.append("categoryId", cateId);
    formData.append("categoryName", cateNameField.value);
    formData.append("updateCategory", "category update");

    let param = {
        method: "POST",
        header: {},
        body: formData
    }

    fetch("submittingFormData.php", param)
        .then(response => response.text())
        .then((data) => {
            alert(data);
            formContainer.style.display = "none";
        })
})