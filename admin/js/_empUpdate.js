
//send updated data to server using ajax
const submit = document.getElementById("update");
const res = document.getElementById("response");

//all, document element
const employeeName = document.getElementById("empName");
const email = document.getElementById("empEmail");
const mobile = document.getElementById("mobile");
const adr = document.getElementById("empAddress");
const age = document.getElementById("empAge");
const category = document.getElementById("empCategory");
const adharNo = document.getElementById("adharNo");
const panNo = document.getElementById("panNo");
const adharImg = document.getElementById("adharImage");
const panImage = document.getElementById("panCardImage");
const profile = document.getElementById("empProfile");
const empId = document.getElementById("empId");
const profileImgPath = document.getElementById("empProfileImgPath");
const adharImgPath = document.getElementById("adharImagePath");
const panImgPath = document.getElementById("panImagePath");
const empOldStatus = document.getElementById("oldStatus");
const oldCategory = document.getElementById("oldCategory");
const empStatus = document.getElementById("empStatus");

//dynamic variables for add and removing classes
const side = document.getElementsByTagName("aside")[0];
const main = document.getElementById("dashboard");

//sending data to server which are updated
const sendData = (event) => {
    event.preventDefault();
    let con = confirm("Are you sure to update this information..!");
    if (con) {
        let submit = "update Employee";

        let adharCard = adharImg.files[0];
        let panCard = panImage.files[0];
        let profilePicture = profile.files[0];

        // console.log(adharCard);
        // console.log(panCard);
        // console.log(profilePicture);
        console.log("function called");
        let formData = new FormData();

        // console.log(adharCard);
        // console.log(panCard);
        // console.log(profilePicture);

        formData.append("empName", employeeName.value);
        formData.append("empEmail", email.value);
        formData.append("mobile", mobile.value);
        formData.append("empAddress", adr.value);
        formData.append("age", age.value);
        formData.append("empCategory", category.value);
        formData.append("adharNo", adharNo.value);
        formData.append("panNo", panNo.value);
        formData.append("empId", empId.value);
        formData.append("empStatus", empStatus.value);
        formData.append("oldEmpStatus", empOldStatus.value);
        formData.append("oldCategory", oldCategory.value);

        formData.append("profileImgPath", profileImgPath.value);
        formData.append("adharImgPath", adharImgPath.value);
        formData.append("panImgPath", panImgPath.value);

        formData.append("adharCard", adharCard);
        formData.append("panCard", panCard);
        formData.append("profile", profilePicture);

        formData.append("employeeUpdate", submit);

        let param = {
            "method": "POST",
            "header": {},
            "body": formData
        };

        fetch('submittingFormData.php', param)
            .then((response) => response.text())
            .then((data) => {
                res.innerHTML = data;
                if (data.includes("Record Updated Successfully..!")) {
                    document.getElementById("emp-update-form").reset();
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
}
window.onload = () => {
    empName.focus();
}
submit.addEventListener("click", sendData);


//close the open employee report window
const closeBtn = document.getElementById("close-table-btn");
const openBtn = document.getElementById("display-btn");
const table = document.getElementById("table");

openBtn.addEventListener("click", (e) => {
    e.preventDefault();
    table.style.display = "block";
    side.classList.add("hide-sidebar");
    main.classList.add("full-display");
})

closeBtn.addEventListener("click", (e) => {
    e.preventDefault();
    table.style.display = "none";
    side.classList.remove("hide-sidebar");
    main.classList.remove("full-display");
})

//open the new category assign box script here
const formBox = document.getElementById("login-container");
const displayBtn = document.getElementById("set-category");
const closeFormBtn = document.getElementById("close-form-box");

displayBtn.addEventListener("click", (e) => {
    formBox.style.display = "block";
})

closeFormBtn.addEventListener("click", (e) => {
    formBox.style.display = "none";
})

//click event to all select buttons
const anchorBtn = document.querySelectorAll("#table .content .table-box table tr td button");
anchorBtn.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        let parent = btn.parentNode;
        let id = parent.previousElementSibling.textContent;
        let formData = new FormData();
        formData.append("emp_id", id);
        formData.append("fetch_for_update", "data");

        let param = {
            header: {},
            method: "POST",
            body: formData
        }

        fetch("submittingFormData.php", param)
            .then(response => response.json())
            .then((data) => {

                employeeName.value = data.emp_name;
                email.value = data.emp_email;
                adr.value = data.emp_address;
                age.value = data.emp_age;
                adharNo.value = data.adhar_card_no;
                panNo.value = data.pan_card_no;
                profileImgPath.value = data.profile_picture;
                adharImgPath.value = data.adhar_image;
                panImgPath.value = data.pan_card_image;
                mobile.value = data.emp_mobile_no;
                empId.value = data.emp_id;
                oldCategory.value = data.category_id;
                empOldStatus.value = data.emp_status;

                table.style.display = "none";
                side.classList.remove("hide-sidebar");
                main.classList.remove("full-display");

            })
            .catch((err) => {
                alert(err);
            })
    })
})

//activating search bar of employee report table
const searchBar = document.getElementById("search-input");
const searchElement = document.querySelectorAll("#table .content .table-box table .searchRow");
const display = () => {
    searchElement.forEach((tr) => {
        let data = tr.children[0].textContent.toUpperCase();
        let search = searchBar.value.toUpperCase();
        if (data.indexOf(search) > -1) {
            tr.style.display = "";
        } else {
            tr.style.display = "none";
        }
    })
}
searchBar.addEventListener("keyup", display)


//deleting the selected employee from working table as per admin request and add it to the un-worked employee table
const deleteBtn = document.getElementById("delete");
const form = document.getElementById("emp-update-form");
const deleteDetails = (e) => {
    e.preventDefault();
    let con = confirm("Are you sure,to remove this details..!");
    if (con) {
        let submit = "removeData";
        let formData1 = new FormData();
        formData1.append("empId", empId.value);
        formData1.append("remove", submit);
        let param1 = {
            method: "POST",
            header: {},
            body: formData1
        };
        fetch("submittingFormData.php", param1)
            .then(response => response.text())
            .then((data) => {
                alert(data);
                res.innerHTML = data;
                if (data.includes("Employee Removed from Working list and status updated to 'Not Working'")) {
                    res.style.color = "green";
                    document.getElementById("emp-update-form").reset();
                } else {
                    res.style.color = "red";
                    setTimeout((e) => {
                        res.innerHTML = "";
                    }, 500);
                }
            }).catch((err) => res.innerHTML = err);
    } else {
        document.getElementById("emp-update-form").reset();
    }
}
deleteBtn.addEventListener("click", deleteDetails);



//submitting assign category form here
const assignNowBtn = document.getElementById("add-cate");
const assignCateId = document.getElementById("newCategory");
const assignEmpEmail = document.getElementById("assignEmpEmail");
assignNowBtn.addEventListener("click", (e) => {
    e.preventDefault();

    let formData2 = new FormData();
    formData2.append("assignNewCateId", assignCateId.value);
    formData2.append("assignToEmail", assignEmpEmail.value);
    formData2.append("insertToCategoryEmployee", "data");

    let param2 = {
        method: "POST",
        header: {},
        body: formData2
    };

    fetch("submittingFormData.php", param2)
        .then(response => response.text())
        .then((data) => {
            alert(data);
            if (data.includes("Record Inserted Successfully...")) {
                document.getElementById("assign-category-form").reset();
            }
        })
})



//sending data to submittingFormData.php file to remove all record from category_employee having given emp_email
const assignDeleteBtn = document.getElementById("delete-from-cate-emp");
assignDeleteBtn.addEventListener("click", (e) => {
    e.preventDefault();
    let con = confirm("Are you sure to delete all data related to given email");
    if (con) {
        let formData3 = new FormData();
        formData3.append("delete-emp-email", assignEmpEmail.value);
        formData3.append("delete-from-category_employee", "data");

        let param3 = {
            method: "POST",
            header: {},
            body: formData3
        };

        fetch("submittingFormData.php", param3)
            .then(response => response.text())
            .then((data) => {
                alert(data);
                if (data.includes("All Records are Deleted..")) {
                    document.getElementById("assign-category-form").reset();
                    document.getElementById("login-container").style.display = "none";
                }
            })
    } else {
        document.getElementById("assign-category-form").reset();
    }

})