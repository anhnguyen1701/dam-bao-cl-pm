function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    // document.getElementById("main").style.marginLeft = "250px";
    document.getElementsByTagName("main")[0].style.opacity = 0.1;
    document.getElementsByTagName("header")[0].style.opacity = 0.1;
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    // document.getElementById("main").style.marginLeft = "0";
    document.getElementsByTagName("main")[0].style.opacity = 1;
    document.getElementsByTagName("header")[0].style.opacity = 1;
}