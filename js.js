var menuBool = 0;

function openMenu(buttonId, height) {
    document.getElementById(buttonId).style.height = height;

    menuBool = 1;
    console.log(buttonId + " has been opened.");
}

function closeMenu(buttonId) {
    document.getElementById(buttonId).style.height = 0;
    menuBool = 0;
    console.log(buttonId + " has been closed.");
}

function getScreenSizes() {
    var array = [getScreenHeight(), getScreenWidth()]
    return array;
}

function getScreenWidth() {
    return window.innerWidth;
}

function getScreenHeight() {
    return window.innerHeight;
}

function photoMenu() {
    var photoArrow = document.getElementById("photoArrow");
    if (menuBool == 0) {
        openMenu('photoGrid', '100vh');
        photoArrow.innerHTML = "keyboard_arrow_up";
        menuBool = 1;
    } else {
        closeMenu('photoGrid');
        photoArrow.innerHTML = "keyboard_arrow_down";
        menuBool = 0;
    }
}

function placeMenu(placesID) {
    var placeArrow = document.getElementById('placesArrow' + placesID);
    if (menuBool == 0) {
        var menuSize = 'auto';
        openMenu('places' + placesID, menuSize);
        placeArrow.innerHTML = "keyboard_arrow_up";
        menuBool = 1;
        console.log(placesID);
        //closes the second city info box
        if (placesID == '0') {
            var cityInfo = document.getElementById("cityInfo1");
            cityInfo1.style.visibility = "hidden";
            cityInfo.style.height = "0";
            console.log("Other box is hidden");
        }
        //closes the first city info box
        else {
            var cityInfo = document.getElementById("cityInfo0");
            cityInfo.style.visibility = "hidden";
            cityInfo.style.height = "0";
            console.log("Other box is hidden");
        }
    } else {
        closeMenu('places' + placesID);
        placeArrow.innerHTML = "keyboard_arrow_down";
        menuBool = 0;
        if (placesID == '0') {
            var cityInfo = document.getElementById("cityInfo1");
            cityInfo.style.visibility = "";
            cityInfo.style.height = cityInfo1Height;
            console.log("Other box is shown");
        } else {
            var cityInfo = document.getElementById("cityInfo0");
            cityInfo.style.visibility = "";
            cityInfo.style.height = cityInfo0Height;
            console.log("Other box is shown");
        }
    }
}

function xmlMenu() {
    if (menuBool == 0) {
        openMenu('xml-form', 'auto');
        xmlArrow.innerHTML = "keyboard_arrow_up";
        menuBool = 1;
        console.log(menuBool);
    } else {
        closeMenu('xml-form');
        xmlArrow.innerHTML = "keyboard_arrow_down";
        menuBool = 0;
    }
}

function mapMenu(map, arrow, button) {
    var arrow = document.getElementById(arrow);
    var button = document.getElementById(button);
    if (menuBool == 0) {
        openMenu(map, '100vh');
        arrow.innerHTML = "keyboard_arrow_up";
        menuBool = 1;
        console.log(menuBool);

        button.disabled = true;
        button.classList.add("disabled");

    } else {
        closeMenu(map);
        arrow.innerHTML = "keyboard_arrow_down";
        button.disabled = false;
        button.classList.remove("disabled");
        menuBool = 0;
    }

}
