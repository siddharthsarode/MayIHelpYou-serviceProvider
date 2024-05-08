//search bar activate here
const searchBar = document.querySelector(".table-container .table-content .header #serviceSearchBar");
const searchElements = document.querySelectorAll(".table-container .table-content .table-data .table table tr .searchServiceName");
searchBar.addEventListener("keyup", (e) => {
    let searchValue = searchBar.value.toUpperCase();
    searchElements.forEach(element => {
        let elementValue = element.textContent.toUpperCase();
        if (elementValue.indexOf(searchValue) > -1) {
            element.parentNode.style.display = "";
        } else {
            element.parentNode.style.display = "none";
        }
    })
})

window.onload = () => {
    searchBar.focus();
}

//image viewer added here
const imageContainer = document.getElementById("image-content");
const imageListDiv = document.querySelectorAll("#image-content .hidden-img .image-list");
const originalImgList = document.querySelectorAll(".table-container .table-content .table-data .table table tr td .original-img");
const closeBtn = document.querySelectorAll("#image-content .hidden-img .image-list .header .close-btn");

originalImgList.forEach(img => {
    img.addEventListener("click", (e) => {
        let imgAttribute = img.getAttribute("data-link");
        let serviceHeading = img.parentNode.parentNode.firstElementChild.textContent;
        imageListDiv.forEach(showElement => {
            let showAttribute = showElement.getAttribute("data-target");
            if (imgAttribute === showAttribute) {
                imageContainer.style.display = "block";
                showElement.style.display = "block";
                showElement.firstElementChild.firstElementChild.nextElementSibling.innerHTML = serviceHeading;
            }
        })
    })
})

closeBtn.forEach(btn => {
    btn.addEventListener("click", (e) => {
        imageContainer.style.display = "none";
        btn.parentNode.parentNode.style.display = "none";
        searchBar.focus();
    })
})
