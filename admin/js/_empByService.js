const searchBar = document.getElementById("empSearchBar");
const searchKey = document.querySelectorAll(".table-container .table-content .table-data .table table tr .searchEmployeeName");
searchBar.addEventListener("keyup", (e) => {
    let searchValue = searchBar.value.toUpperCase();
    searchKey.forEach(key => {
        let keyValue = key.textContent.toUpperCase();
        if (keyValue.indexOf(searchValue) > -1) {
            key.parentNode.style.display = "";
        } else {
            key.parentNode.style.display = "none";
        }
    })
})

window.onload = () => {
    searchBar.focus();
}


//change color according to the status
const empStatus = document.querySelectorAll(".table-container .table-content .table-data .table table tr .empStatus");
empStatus.forEach(sts => {
    let text = sts.textContent.toUpperCase();
    if (text === "NEW")
        sts.style.color = "blue";
    else if (text === "NOT WORKING")
        sts.style.color = "red";
    else if (text === "ABSENT")
        sts.style.color = "orange";
    else if (text === "PRESENT")
        sts.style.color = "green";
})