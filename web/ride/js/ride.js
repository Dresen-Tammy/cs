


function changeTrail() {
        var value = document.getElementById('selectTrail').value;
        var trailForm = document.getElementById('setTrailInfo');
        var trailInfo = document.getElementById('trailInfo');
        var locationInput = document.getElementById('locationInput');
        var distanceInput = document.getElementById('distanceInput');
        var elevationInput = document.getElementById('elevationInput');

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
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    //process results
                    handleTrailInfo(xhr.responseText);
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

    var trailList = JSON.parse(jsonString);
    var trailInfo = document.getElementById('trailInfo');
    var output = "<span class='label'>Start Location: </span><span class='inputs'>" + trailList['start_location'] + "</span><br>";
    output += "<span class='label'>Distance: </span><span class='inputs'>" + trailList['distance'] + " miles</span><br>";
    output += "<span class='label'>Elevation Gain: </span><span class='inputs'>" + trailList['elevation'] + " feet</span><br>";

    trailInfo.innerHTML =  output;
}

function noShow() {
    var trailForm = document.getElementById('setTrailInfo');
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
