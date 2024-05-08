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