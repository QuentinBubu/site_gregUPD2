const mobile_menu = document.getElementById("phone_menu");
const topBarre = document.getElementsByClassName("top_bar");
const body = document.querySelector("body");
const div = document.getElementById("top-bar-nav");

mobile_menu.addEventListener("click", function() {
    const div = document.getElementById("top-bar-nav");
    if (div.style.display === "none") {
        div.style.display = "block";
        topBarre[0].style.position = "fixed";
    } else if (div.style.display === "block") {
        div.style.display = "none";
        topBarre[0].style.position = "static";
    } else {
        div.style.display = "block";
        topBarre[0].style.position = "fixed";
    }
}, false);

if (window.getComputedStyle(mobile_menu, null).getPropertyValue("display") !== "none") {
    const list = document.querySelectorAll("#breakPoints>ul>li");
    for (let i = 0; i < list.length; i++) {
        list[i].addEventListener("click", function() {
            div.style.display = "none";
            topBarre[0].style.position = "static";
        }, false);
    }
}