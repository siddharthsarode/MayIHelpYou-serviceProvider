//focus event added
const payment = document.getElementById("payment-page");
window.onload = () => {
    if (payment.style.display === "none")
        document.getElementById("addr").focus();
    else
        document.getElementById("transactionId").focus();
}

//Accepting order from user
const bookingBtn = document.getElementById("booking-btn");
const closeBtn = document.getElementById("close-payment-page");
const paymentFormDiv = document.getElementById("payment-page");
const paymentForm = document.getElementById("payment-details-form");
const orderForm = document.getElementById("orderForm");

const acceptDetails = (e) => {
    e.preventDefault();
    let name = document.getElementById("customerName").value;
    let address = document.getElementById("addr").value;
    let city = document.getElementById("city").value;
    let phone = document.getElementById("phone").value;
    let serviceId = document.getElementById("service_id").value;

    let formData = new FormData();

    formData.append("phone", phone);
    formData.append("city", city);
    formData.append("addr", address);
    formData.append("customerName", name);
    formData.append("service_id", serviceId);
    formData.append("booking", "values");

    let param = {
        method: "POST",
        header: {},
        body: formData
    }

    fetch("_orderBook.php", param)
        .then(response => response.text())
        .then((data) => {
            alert(data);
            if (data.includes("Details Accepted ,Pay Advance Online")) {
                paymentFormDiv.style.display = "block";
                paymentFormDiv.style.backdropFilter = "blur(2px)";
                document.getElementById("transactionId").focus();
            }
        })
}

//close payment form 
closeBtn.addEventListener("click", (e) => {
    paymentFormDiv.style.display = "none";
    // orderForm.reset();
});

//Accepting payment and confirm user service order
const paymentBtn = document.getElementById("payment-btn");
const storeDetails = (e) => {
    e.preventDefault();
    let con = confirm("Are you confirm this order !!");
    if (con) {
        let transactionId = document.getElementById("transactionId").value;
        let formData = new FormData();

        formData.append("transactionId", transactionId);
        formData.append("order_confirm", "confirm");

        let param = {
            method: "POST",
            header: {},
            body: formData
        }
        fetch("_orderBook.php", param)
            .then(response => response.text())
            .then((data) => {
                alert(data);
                if (data.includes("Order Accepted")) {
                    paymentFormDiv.style.display = "none";
                    paymentForm.reset();
                    // orderForm.reset();
                }
            })
    } else {
        sessionStorage.removeItem("order_name");
        sessionStorage.removeItem("order_city");
        sessionStorage.removeItem("order_phone");
        sessionStorage.removeItem("order_adr");
        sessionStorage.removeItem("service_id");
        orderForm.reset();
        paymentFormDiv.style.display = "none";
    }
}
paymentBtn.addEventListener("click", storeDetails);
bookingBtn.addEventListener("click", acceptDetails);