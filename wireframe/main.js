/**
 * 
 * @desc this file helps to display the right nav element depending of the screen width 
 * 
 * @author Novitz Jean-Philippe (jphNovitz)
 *  
 */

/**
 *  FUNCTIONS LIBRARY
 */

/**
 * @function request
 * @param string $url
 * @description instanciate a XLMHTTP object, send a GET request using the $url parameter
 * 
 */
var request = function (url) {
  return new Promise(function (resolve, reject){
    var client = new XMLHttpRequest();
      client.onreadystatechange = function(){
        if (client.readyState === 4){
          if (client.status === 200){
            resolve(client.responseText)
          } else {
            reject(client)
          }
        } 
      }
    client.responseType = '';
    client.open('GET', url, true);
    client.send(null  )
  })     
}

/**
 * @function getSize
 * @description check the screen width, if it's bigger than 502 -> return 0 else return 1
 * 0 and 1 is good because there are two templates available in an array
 * 
 */
function getSize() {
  screenWidth = window.screen.width
    if (screenWidth < 502){
      return 0
    }else{
      return 1
    }
}


/**
 * @function displayTemplate
 * @param array $template
 * @param integer $id
 * @description receive a templates which is an array of (2) tempaltes and an id, modify the <nav> </nav> element
 * 
 * 
 */
var displayTemplate = function (templates, id) {
  document.getElementsByTagName('NAV')[0].innerHTML = templates[id]
}

/**
 * @description manage click on the hamburger button
 */
function manageButtonClick(){
  let clicked = 0 // flag 0/1 clicked/not clicked
  let button = document.getElementById('menu-button')
  button.addEventListener('click', function(e){
    let menu = document.getElementsByClassName("menu-wrap")[0]
    if (!clicked){
      menu.style.opacity=1
      menu.style.height="200px"
      clicked = 1
    } else {
      menu.style.opacity=0
      menu.style.height="1px"
      clicked = 0
    }
  })
} 

/**
 *  main
 */

Promise.all([
    request('nav_v.html'),
    request('nav_h.html')
  ]).then((templates) => {
    displayTemplate(templates, getSize()) // get screen width
   
    window.addEventListener('resize', function(){  // listen to the resize event
      displayTemplate(templates, getSize())
    })

    manageButtonClick() //listen to the click
  })


