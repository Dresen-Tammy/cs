
function changeTrail() {
    const value = document.getElementById('selectTrail').value;
    const trailForm = document.getElementById('setTrailInfo');
    const trailInfo = document.getElementById('trailInfo');
    const locationInput = document.getElementById('locationInput');
    const distanceInput = document.getElementById('distanceInput');
    const elevationInput = document.getElementById('elevationInput');

    if (value == -1) {
        // add new trail fieldset displays
        noShow();
        trailInfo.innerHTML = "";
        locationInput.required = true;
        distanceInput.required = true;
        elevationInput.required = true;

    } else if (value >= 0) {
        // display info about trail
        if (!trailForm.classList.contains('noShow')) {
            trailForm.classList.add('noShow');
        }
        locationInput.required = false;
        distanceInput.required = false;
        elevationInput.required = false;
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                //process results
                var response = xhr.responseText
                handleTrailInfo(response);
            }
        };
        xhr.open("GET", "./api.php?trail=" + value, true);
        xhr.send();
    } else {
        // hide trail info and hide trail fieldset
        trailInfo.innerHTML = ""

        if (!trailForm.classList.contains('noShow')) {
            trailForm.classList.add('noShow');
        }
        locationInput.required = false;
        distanceInput.required = false;
        elevationInput.required = false;
    }
}

function handleTrailInfo(jsonString) {

    const trailList = JSON.parse(jsonString);
    const trailInfo = document.getElementById('trailInfo');
    let output = "<span class='label'>Start Location: </span><span class='inputs'>" + trailList['start_location'] + "</span><br>";
    output += "<span class='label'>Distance: </span><span class='inputs'>" + trailList['distance'] + " miles</span><br>";
    output += "<span class='label'>Elevation Gain: </span><span class='inputs'>" + trailList['elevation'] + " feet</span><br>";

    trailInfo.innerHTML =  output;
}
function editRide() {
    const name = document.getElementById('editName').value;
    const date = document.getElementById('editDate').value;
    const trail = document.getElementById('selectTrail2').value;
    const ride = document.getElementById('rideId').value;
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //process results
            $response = xhr.responseText;
            handleRideUpdate($response);
        }
    };
    xhr.open("GET", "./api2.php?id=" + ride + "&name=" + name + "&date=" + date + "&trail=" + trail, true);
    xhr.send();


}

function handleRideUpdate(jsonString) {
    const rideList = JSON.parse(jsonString);
    document.getElementById('listDate').innerHTML = "Date: " + rideList['ride_date'];
    document.getElementById('listTrail').innerHTML = "Trail: " +rideList['trail_name'];
    document.getElementById('listDistance').innerHTML = "Distance: " + rideList['distance'] + " miles";
    document.getElementById('listElevation').innerHTML = "Elevation " + rideList['elevation'] + " feet";
    document.getElementById('selectChoice').value = rideList['trail_id'];
    document.getElementById('title').innerHTML = rideList['ride_name'];
    hideForm4();

}
function noShow() {
    const trailForm = document.getElementById('setTrailInfo');
    if (trailForm.classList.contains('noShow')) {
        trailForm.classList.remove('noShow');
    }
}



function hideForm() {
    let dateForm = document.getElementById('dateForm');
    if (!dateForm.classList.contains('hide')) {
        dateForm.classList.add('hide');
    }
}
function unhide() {
    let dateForm = document.getElementById('dateForm');
    if (dateForm.classList.contains('hide')) {
        dateForm.classList.remove('hide');
    }
}
function hideForm2() {
    let dateForm = document.getElementById('trailList');
    if (!dateForm.classList.contains('hide')) {
        dateForm.classList.add('hide');
    }
}
function hideForm4() {
    let dateForm = document.getElementById('editRide');
    if (!dateForm.classList.contains('hide')) {
        dateForm.classList.add('hide');
    }
}
function unhide2() {
    let dateForm = document.getElementById('trailList');
    if (dateForm.classList.contains('hide')) {
        dateForm.classList.remove('hide');
    }
}
function unhide3() {
    let dateForm = document.getElementById('trailForm');
    if (dateForm.classList.contains('hide')) {
        dateForm.classList.remove('hide');
    }
}
function unhide4() {
    let dateForm = document.getElementById('editRide');
    if (dateForm.classList.contains('hide')) {
        dateForm.classList.remove('hide');
    }
    const selectList = document.getElementById('selectTrail2');
    const selectChoice = document.getElementById('selectChoice').value;

       selectList.value = selectChoice;

}

