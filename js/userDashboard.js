
// User Profile Editing functionality Added 

const editBtn = document.querySelectorAll('.edit-btn');
const radioMale = document.getElementById("male");
const radioFemale = document.getElementById("female");
editBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
        const form = btn.parentElement.nextElementSibling;
        const saveBtn = form.querySelector('.save-btn');
        inputArray = Array.from(form.querySelectorAll('input'));
        form.classList.toggle('input-display');

        if (form.className == "dash-form input-display") {
            inputArray.forEach((e) => {
                e.removeAttribute('disabled');
            });
            btn.innerText = "Cancel";
            console.log(saveBtn);
            saveBtn.classList.toggle('btn-active');
        } else {
            btn.innerText = "Edit";
            inputArray.forEach((e) => {
                e.setAttribute('disabled', false);
            });
            saveBtn.classList.toggle('btn-active');
        }
    })
})