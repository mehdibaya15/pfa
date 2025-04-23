document.addEventListener("DOMContentLoaded", function () {

    const links = document.querySelectorAll(".nav-link");
    const currentPage = window.location.pathname.split("/").pop(); 
    links.forEach(link => {
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active"); 
        } else {
            link.classList.remove("active"); 
        }
    });
});

function click(){
    window.location.href="boutique.html";
}


document.addEventListener("DOMContentLoaded", function() {
    var boutiquetButton = document.getElementById("boutiqueButton");
    
    if (boutiqueButton) {
        boutiqueButton.addEventListener("click", click);
    }
});