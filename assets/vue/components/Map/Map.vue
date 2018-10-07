<template>
        <div id="mapid"></div>
</template>

<script>
    export default {
        name: "Map",
        data (){
            return {
                visitorLAT: 50.645437,
                visitorLONG: 5.523483,
                // icon: L.icon({
                //     iconUrl: 'logo_clem.png',
                //     shadowUrl: 'leaf-shadow.png',
                //
                //     iconSize:     [38, 95], // size of the icon
                //     shadowSize:   [50, 64], // size of the shadow
                //     iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                //     shadowAnchor: [4, 62],  // the same for the shadow
                //     popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                // })
            }
        },
        computed: {},
        created(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(position => {
                    this.visitorLAT =  position.coords.latitude;
                    this.visitorLONG =  position.coords.longitude;
                })
            }
        },
        mounted (){
            const  mymap = L.map('mapid').setView([50.645437, 5.523483], 13);
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoiamlwaGkiLCJhIjoiY2ptdGpsaDBwMWFzZTNxbDhudmRhN3pkcCJ9.pG2JbFxQ4Vtwt4dOxvgGoA'
            }).addTo(mymap);


            const clem = L.circle([50.645437, 5.523483], {
                // icon: this.icon,
                color: 'orangered',
                fillColor: '#ff7f0d',
                fillOpacity: 0.5,
                radius: 100
            }).addTo(mymap);
            clem.bindPopup("<b>La clémentine </b><br>Une petite faim ?!");

            const lidl = L.marker([50.646033, 5.525093], {
                color: 'blue',
                fillColor: '#fcff9d'
            }).addTo(mymap);
            lidl.bindPopup("Lidl").openPopup();

            const athenee = L.marker([50.643842, 5.520184], {
                color: 'blue',
                fillColor: '#fcff9d'
            }).addTo(mymap);
            athenee.bindPopup("Athenée");

            const visitor = L.marker([this.visitorLAT, this.visitorLONG] , {
                color: 'red'
            }).addTo(mymap);
            visitor.bindPopup("Vous êtes ici").openPopup();

         },
        methods: { }
    }

</script>

<style scoped>
        #mapid {
        width: 100vw;
        height: 100vh ;

    }
    @media (min-width: 502px) {
            #mapid {
                width: 100%;
                height: calc(60vw/1.5) ;
                margin: 3rem auto;
            }
        }
</style>