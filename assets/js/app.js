// button is the hamburger icon and menu is the lateral menu hidden by default
const button = document.getElementById('menu');
const menu = document.getElementById('lateral-menu');
const test = document.getElementsByTagName('input');
for (let i=0 ; i< test.length ; i++){
    test[i].addEventListener("focusin", function (event) {
        this.style.bottom = "-2px";
    });
    test[i].addEventListener("focusout", function (event) {
        if (this.value){
            this.style.bottom = "-2px";
        }else {
            this.style.bottom = "26px";
        }
    })
}
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

