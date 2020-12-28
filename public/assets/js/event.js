const mobile_menu = document.querySelector("#phone_menu");
const topBarre = document.querySelectorAll(".top_bar");
const div = document.querySelector("#top-bar-nav");
const startDiapo = document.querySelector("#startDiapo");
let iframeLocation = document.querySelector("#iframeLocation");

window.addEventListener("load", function() {
    iframeLocation.innerHTML = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2819.103088143903!2d5.0657821154387195!3d45.043129879098224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f54d5db890eae9%3A0x773101873de7c799!2s2%20R%C3%A9sidence%20Alfred%20de%20Musset%2C%2026100%20Romans-sur-Is%C3%A8re!5e0!3m2!1sfr!2sfr!4v1609015919813!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0; outline: transparent;" allowfullscreen="" aria-hidden="false" tabindex="0" id="maps" title="map"></iframe>';
});

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

startDiapo.addEventListener("click", function(){
    demarrageDiapo();
});