
// check login person is admin or employee
const head = document.getElementById("adminHeading");
const login = document.getElementById("checkAdmin");
const toggle = () => {
    if (login.checked == true) {
        head.innerHTML = "Employee Login";
    }
    else
        head.innerHTML = "Admin Login";
}
//check forget password person admin or employee
const forgetHead = document.getElementById("forgetHeading");
const forget = document.getElementById("forgetCheck");
const toggleForget = () => {
    if (forget.checked == true) {
        forgetHead.innerHTML = "Employee Forget Password";
    }
    else
        forgetHead.innerHTML = "Admin Forget Password";
}
//click to child on clicking parent(Employee Dashboard)
const operation = document.querySelectorAll(".admin-operations .content .sub-operation ul li");
operation.forEach((list) => {
    list.addEventListener("click", (e) => {
        console.log("list clicked");
        list.children[0].click();
    })
})


//