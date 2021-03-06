// Initialize Firebase
let config = {
    apiKey: "AIzaSyCcp8-gGoUtUF46GwhZMP07sAYPvzd4ZhE",
    authDomain: "sarathi-5e339.firebaseapp.com",
    databaseURL: "https://sarathi-5e339.firebaseio.com",
    projectId: "sarathi-5e339",
    storageBucket: "sarathi-5e339.appspot.com",
    messagingSenderId: "9544459693",
    appId: "1:9544459693:web:cbee8f5b5b5828d5"
};
var db = firebase.initializeApp(config).database();

var { LMap, LTileLayer, LMarker } = Vue2Leaflet;
var userRefs = db.ref('locations')
new Vue({
    el: '#app',
    components: { LMap, LTileLayer, LMarker },
    data() {
        return {
            myUuid : localStorage.getItem('myUuid'),
            zoom:13,
            center: L.latLng(27.7172, 85.3240),
            url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution:'&copy; <a href=http"://osm.org/copyright">OpenStreetMap</a> contributors',
            marker: L.latLng(27.7172, 85.3240),
            watchPositionId : null
        }
    },
    mounted(){
        var vm = this
        if (!vm.myUuid) {
            vm.myUuid = vm.guid();
            localStorage.setItem('myUuid', vm.myUuid);
        }else{

            vm.watchPositionId = navigator.geolocation.watchPosition(vm.successCoords, vm.errorCoords);

        }



    },
    firebase: {
        users: userRefs.limitToLast(25)
    },
    methods:{
        successCoords(position) {
            var vm = this
            if (!position.coords) return

            userRefs.child(vm.myUuid).set({
                coords: {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude,
                },
                timestamp: Math.floor(Date.now() / 1000)
            })
            vm.center = L.latLng([position.coords.latitude, position.coords.longitude])
            vm.marker = L.latLng([position.coords.latitude, position.coords.longitude])
        },
        errorCoords() {
            console.log('Unable to get current position')
        },
        guid() {
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
            }
            return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
        }
    }
});


