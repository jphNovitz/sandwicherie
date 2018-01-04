// button is the hamburger icon and menu is the lateral menu hidden by default
const button = document.getElementById('menu');
const menu = document.getElementById('lateral-menu');
/*button.addEventListener("click", function(){
    menu.style.marginLeft = '0vw';
});*/
document.addEventListener("click", function (event) {
    if(event.target === button){
        menu.style.marginLeft = '0vw';
    } else {
        menu.style.marginLeft = '-100vw';
    }
})

