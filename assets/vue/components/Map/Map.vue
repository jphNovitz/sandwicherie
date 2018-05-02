<template>
        <div class="google-map" id="map"> </div>
</template>

<script>
    export default {
        name: "Map",
        //props: ['markerCoordinates'],
        data (){
            return {
                key: 'AIzaSyD8VwmSjvYXfjvMFZ9lH2-6vlGI_0-gjS0',
             /*   markerCoordinates: [{
                    latitude: 50.645437,
                    longitude: 5.523483
                },
                    {latitude: 50.639436,
                        longitude: 5.531717
                    }
                ],*/
               markerCoordinates: [],
                bounds: null,
                markers: [],
                map: null

            }
        },
        computed: {
          /*  markerCoordinates: function () {
                let coordsList= [{
                    latitude: 50.645437,
                    longitude: 5.523483
                }]
               // let position = this.getPosition()
                coordsList.push(this.getPosition())
                return coordsList
            } */
        },
        created (){
                let coordsList= [{
                    latitude: 50.645437,
                    longitude: 5.523483
                }]
                coordsList.push(this.getPosition())
                this.markerCoordinates = coordsList
        },
        mounted () {

            this.bounds = new google.maps.LatLngBounds();
            const element = document.getElementById('map')
            const options = {
                zoom: 12,
                center: new google.maps.LatLng(50.64, 5.52)

            }
            this.map = new google.maps.Map(element, options);
            let that = this
                setTimeout(function () {
                    that.setMarkers()
                }, 300)
            /*this.markerCoordinates.forEach((coord, count) => {
                let icon = null
                if (count === 0 )
                {
                    icon = require('./logo_clem.png')
                }

                const position = new google.maps.LatLng(coord.latitude, coord.longitude);

                const marker = new google.maps.Marker({
                    position,
                    map: this.map,
                    icon: icon
                })
                this.markers.push(marker)
                this.map.fitBounds(this.bounds.extend(position))

            })*/


        },
        methods: {
            getPosition: function () {
                var marker = {};
                if (navigator.geolocation) {
                    let that=this
                    navigator.geolocation.getCurrentPosition(function (position) {

                        marker.latitude = position.coords.latitude
                        marker.longitude = position.coords.longitude

                    });
                    return marker
                }
            },
            setMarkers: function () {
                this.markerCoordinates.forEach((coord, count) => {
                    let icon = null
                    if (count === 0 )
                    {
                        icon = require('./logo_clem.png')
                    }

                    const position = new google.maps.LatLng(coord.latitude, coord.longitude);

                    const marker = new google.maps.Marker({
                        position,
                        map: this.map,
                        icon: icon
                    })
                    this.markers.push(marker)
                    this.map.fitBounds(this.bounds.extend(position))

                })
            }
        }
    }

</script>

<style scoped>
    .google-map {
        width: 100%;
        height: calc(60vw/1.5) ;
        margin: 3rem auto;
    }
</style>