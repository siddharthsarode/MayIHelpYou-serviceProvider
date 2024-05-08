// Navbar active link code Start

let navbarElements = document.querySelectorAll(".navbar .navbar-link");

navbarElements.forEach(function (link) {
    link.addEventListener('click', function () {
        navbarElements.forEach(function (nav) {
            nav.classList.remove("active-link"); // remove active class
            link.classList.add("active-link");  // add active only clicked button
        });
    });
});

// Navbar active link code End

// Our Member Slider Start here (index.php) page
const slider = document.querySelector("#members-slider");
const sliderBtn = document.querySelectorAll(".slider-btn");
let sliderCardWidth = document.querySelector(".emp-card").offsetWidth;

console.log(sliderCardWidth);
sliderBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
        slider.scrollLeft += btn.id === 'prev' ? -sliderCardWidth : sliderCardWidth;
    })
})

// Our Member Slider End here (index.php) page

//them changer added here
var themChanger = document.getElementById("them-btn");

themChanger.onclick = function () {
    document.body.classList.toggle("dark-them")
    if (document.body.classList.contains("dark-them")) {
        themChanger.textContent = "Light"
    } else {
        themChanger.textContent = "Dark"
    }
}

//them changer ends here

