class GoogleMap {
    map;
    directionsService;
    directionsRenderer;
    markers = [];
    currentPosition = {};
    address = {};

    constructor(zoom, center) {
        this.directionsService = new google.maps.DirectionsService();
        this.directionsRenderer = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });

        this.map = new google.maps.Map(document.getElementById('map'), { zoom: zoom, center: center });
        window.googleMap = this;
        this.directionsRenderer.setMap(this.map);

        var panel = document.getElementById('directions-panel');

        this.directionsRenderer.setPanel(panel);

        this.map.addListener("click", x => {
            
            var latlong = x.latLng.lat().toString();
            var setLocation = { lat: x.latLng.lat(), lng: x.latLng.lng() };
            $.ajax({
                url: "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo&address=" + setLocation.lat + ',' + setLocation.lng,
                method: 'get'
            }).done(x => {

                console.log(x);
                this.address.location = setLocation;
                this.address.alamat = x.results[0].formatted_address;
                this.showdata(this.address);

            })
            // var request = {
            //     origin:this.currentPosition,
            //     destination:setLocation,
            //     travelMode: 'DRIVING',   
            //   };
            //   this.directionsService.route(request, function(response, status) {
            //     if (status == 'OK') {
            //         this.googleMap.directionsRenderer.setDirections(response);
            //         var mappanel = document.getElementById('map-panel');
            //         mappanel.style.display="flex";
            //     }
            //   });
        });
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        this.map.addListener("bounds_changed", () => {
            searchBox.setBounds(this.map.getBounds());
        });
        let markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach(marker => {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            const bounds = new google.maps.LatLngBounds();
            places.forEach(place => {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                        map,
                        icon:icon,
                        title: place.name,
                        position: place.geometry.location
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            this.map.fitBounds(bounds);
        });
        //this.directionsRenderer.setMap(map);
    }

    getAddress = () => {
        return this.address;
    }


    setMarker = (position, title, icon, direction, contentString) => {
        var marker = new google.maps.Marker({ position: position, map: this.map, icon: icon, title:title });
        if (!direction) {
            marker.addListener('click', x => {
                var setLocation = { lat: x.latLng.lat(), lng: x.latLng.lng() };
                var request = {
                    origin: this.currentPosition,
                    destination: setLocation,
                    travelMode: 'DRIVING',
                };
                this.directionsService.route(request, function (response, status) {
                    if (status == 'OK') {
                        this.googleMap.directionsRenderer.setDirections(response);
                        var mappanel = document.getElementById('map-panel');
                        mappanel.style.display = "flex";
                    }
                });
                if(contentString){
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                      });
                      infoWindow.open(map, marker);
                }
            })
        }
    }

    setMarkercari = (position, title, icon) => {
        var geocoder = new google.maps.Geocoder();
        this.geocodeAddress(geocoder, this.map);
    }


    setMarkerCurrent = (position, title, icon) => {
        var marker = new google.maps.Marker({ position: position, map: this.map, icon: icon }, title);
        this.currentPosition = position;
    }


    calcRoute = (awall, akhirr) => {
        var start = awall;
        var end = akhirr;
        var request = {
            origin: start,
            destination: end,
            travelMode: 'DRIVING'
        };
        this.directionsService.route(request, function (result, status) {
            if (status == 'OK') {
                this.directionsRenderer.setDirections(result);
            }
        });
    }


    setCenter = (position) => {

        this.map.setCenter(position);
    }
    geocodeAddress = (geocoder, resultsMap) => {
        const address = document.getElementById("address").value;
        geocoder.geocode({ address: address }, (results, status) => {
            if (status === "OK") {
                resultsMap.setCenter(results[0].geometry.location);
                new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }



    setCurrentPosition = () => {
        var setMaker1 = this.setMarkerCurrent;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = { lat: position.coords.latitude, lng: position.coords.longitude };
                setMaker1(pos, "Your Position", "https://www.robotwoods.com/dev/misc/bluecircle.png");
            }, function (err) {
                // var pos = { lat: position.coords.latitude, lng: position.coords.longitude };
                setMaker1(window.googleMap.map.getCenter(), "Your Position", "https://www.robotwoods.com/dev/misc/bluecircle.png");
                // var infoWindow =new google.maps.InfoWindow({
                //     content: "Your location"
                //   });
                //   window.googleMap.handleLocationError(true, infoWindow, window.googleMap.map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            window.googleMap.handleLocationError(false, infoWindow, this.googleMap.map.getCenter());
        }
    }

    handleLocationError = (browserHasGeolocation, infoWindow, pos) => {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open.map();
    }
}
