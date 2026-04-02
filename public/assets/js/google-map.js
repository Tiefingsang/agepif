function myMap() {
var mapProp= {
    center:new google.maps.LatLng(55.508742,12.120850),
    zoom:5,
};
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
	position: location,
	map: map
});

}