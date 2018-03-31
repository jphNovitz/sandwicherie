
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

var getTemplates = function (){
  return new Promise(function(resolve, reject){
    request('nav_v.html').then(function(response){
      var nav = []
      nav['v']=response
      request('nav_h.html').then(function(response){
        nav['h']=response
        resolve(nav)
      })
      .catch(function(){
        console.log(error)
      })
    }).catch(function(){
      console.log('erreur')
    })
  })

}

getTemplates().then(function(response){
 nav_v = response['v']
 nav_h = response['h']

document.getElementsByTagName('NAV')[0].innerHTML = nav_v

}).catch(function(){
  console.log('erreur')
})

