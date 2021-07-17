function geoFindMe() {

    const lati_sel = document.querySelector('#lati');
    const longi_sel = document.querySelector('#longi');
    const location_status = document.querySelector('.location');
    const loc_status = document.querySelector('#loc_status');
    // const mapLink = document.querySelector('#map-link');

    // mapLink.href = '';
    // mapLink.textContent = '';

    function success(position) {
    const latitude  = position.coords.latitude;
    const longitude = position.coords.longitude;

    loc_status.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
    lati_sel.textContent = latitude ;
    longi_sel.textContent = longitude;
    location_status.style.display="block";
    // mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
    // mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
    }

    function error() {
    loc_status.textContent = 'Unable to retrieve your location';
    }

    if(!navigator.geolocation) {
    loc_status.textContent = 'Geolocation is not supported by your browser';
    } else {
    loc_status.textContent = 'Locating…';
    navigator.geolocation.getCurrentPosition(success, error);
    }

    }

    document.querySelector('#find-me').addEventListener('click', geoFindMe);