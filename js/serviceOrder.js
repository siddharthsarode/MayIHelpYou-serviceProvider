// User question container post feature added
const postBtn = document.getElementById('post-btn');
console.log(postBtn);

postBtn.addEventListener('click', () => {
    const queForm = postBtn.parentElement.nextElementSibling;
    queForm.classList.toggle('show-form');

    if (queForm.classList == "que-form show-form") {
        postBtn.innerText = "Cancel";
    } else {
        postBtn.innerText = "Post your question";
    }
});
