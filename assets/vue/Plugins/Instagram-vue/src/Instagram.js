const Instagram = {}
Instagram.install = function (vue, options= {
        access_token: '5919541710.5106335.21ac2fd8bfd644c2a0390d5a081ca6cb',
        count: 1}) {
    vue.prototype.$insta = new Images(vue, options.access_token, options.count);
   // vue.prototype.$insta.setImages();
}

export default Instagram;

class Images {
    constructor(context, token, count){
        this.context = context ;
        this.token = token ;
        this.count = count ;
        this.images = null ;
    }

    setImages() {
        this.context.http.get('https://api.instagram.com/v1/users/self/media/recent/',
            {params:  {
                    access_token: this.token,
                    count: this.count}} )
            .then(response => {
                this.images =  response.body.data
                console.log(response.body.data)
            }, respnse => {
                console.log(response)
            });
    }

}

/*function get(context, token, count) {
    context.http.get('https://api.instagram.com/v1/users/self/media/recent/',
        {params:  {
                access_token: token,
                count: count}} )
        .then(response => {
            console.log(response)
            console.log('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaah')
             return 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaah'

        }, respnse => {
            console.log(response)
        });

}*/


