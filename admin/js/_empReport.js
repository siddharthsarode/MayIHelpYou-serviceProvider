const search = document.getElementById("empSearchBar");
const show = () => {
    let v = search.value.toUpperCase();
    let key = document.querySelectorAll(".table-data .table table tr .searchKey");
    key.forEach(element => {
        let keyValue = element.textContent.toUpperCase();
        console.log(keyValue);
        console.log(v);
        if (keyValue.indexOf(v) > -1)
            element.parentNode.style.display = "";
        else
            element.parentNode.style.display = "none";
    });

}
search.addEventListener("keyup", show);
window.onload = () => {
    search.focus();
}