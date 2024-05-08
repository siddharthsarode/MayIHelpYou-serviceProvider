const services = ["Plumbing", "Electrical", "Cleaning", "Appliances Repair", "Landscaping", "Gardening", "Carpentry", "Emergency service", "Suppliers"];
const text = document.querySelector(".intro h1 span");

let serviceIdx = 0;
let charIdx = 0;
let isDelete = false;

function textEffect() {

    let currentService = services[serviceIdx];
    let currentChar = currentService.substring(0, charIdx);

    text.classList.add("stop-animation"); // cursor blinking class
    text.textContent = currentChar;

    if (!isDelete && charIdx < currentService.length) {
        charIdx++;
        setTimeout(textEffect, 250);
    } else if (isDelete && charIdx > 0) {
        charIdx--;
        setTimeout(textEffect, 200);
    } else {
        isDelete = !isDelete; // Assign the true value in isDelete variable
        text.classList.remove("stop-animation");

        // Next service text added code
        if (!isDelete) { // // if block executed when isDelete = false
            serviceIdx = (serviceIdx + 1) % services.length;
        }
        setTimeout(textEffect, 1200);
    }
}

textEffect();
