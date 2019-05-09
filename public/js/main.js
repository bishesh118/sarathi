// Initialize Firebase
let firebaseConfig = {
    apiKey: "AIzaSyCcp8-gGoUtUF46GwhZMP07sAYPvzd4ZhE",
    authDomain: "sarathi-5e339.firebaseapp.com",
    databaseURL: "https://sarathi-5e339.firebaseio.com",
    projectId: "sarathi-5e339",
    storageBucket: "sarathi-5e339.appspot.com",
    messagingSenderId: "9544459693",
    appId: "1:9544459693:web:cbee8f5b5b5828d5"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

var database = firebase.database();

var lastIndex = 0;


// Get Data
firebase.database().ref('locations/').on('value', function (snapshot) {
    var value = snapshot.val();
    var htmls = [];
    $.each(value, function (index, value) {
        if (value) {
            htmls.push('<tr>\
        		<td>' + value.location + '</td>\
        		<td>' + value.latitude + '</td>\
        		<td>' + value.longitude + '</td>\
        		<td><a data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="' + index + '">Update</a>\
        		<a data-toggle="modal" data-target="#remove-modal" class="btn btn-outline-danger removeData" data-id="' + index + '">Delete</a></td>\
        	</tr>');
        }
        lastIndex = index;
    });
    $('#tbody').html(htmls);
    $("#submitLocation").removeClass('desabled');
});

// Add Data
$('#submitLocation').on('click', function () {
    var values = $("#addLocation").serializeArray();
    var location = values[0].value;
    var latitude = values[1].value;
    var longitude = values[2].value;
    var locationID = lastIndex + 1;

    firebase.database().ref('locations/' + locationID).set({
        location: location,
        latitude: latitude,
        longitude: longitude,
    });

    // Reassign lastID value
    lastIndex = locationID;
    $("#addLocation input").val("");
});


// Update Data
var updateID = 0;
$('body').on('click', '.updateData', function () {

    updateID = $(this).attr('data-id');
    firebase.database().ref('locations/' + updateID).on('value', function (snapshot) {
        var values = snapshot.val();
        var updateData =
            '<div class="form-group">\
		        <label for="location" class="col-md-12 col-form-label">Location</label>\
		        <div class="col-md-12">\
		            <input id="location" type="text" class="form-control" name="location" value="' + values.location + '" required autofocus>\
		        </div>\
		    </div>\<div class="form-group">\
		        <label for="latitude" class="col-md-12 col-form-label">Latitude</label>\
		        <div class="col-md-12">\
		            <input id="latitude" type="text" class="form-control" name="latitude" value="' + values.latitude + '" required autofocus>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="longitude" class="col-md-12 col-form-label">Longitude</label>\
		        <div class="col-md-12">\
		            <input id="longitude" type="text" class="form-control" name="longitude" value="' + values.longitude + '" required autofocus>\
		        </div>\
		    </div>\
		    ';

        $('#updateBody').html(updateData);
    });
});

$('.updateUserRecord').on('click', function () {
    var values = $(".locations-update-record-model").serializeArray();
    var postData = {
        location: values[0].value,
        latitude: values[1].value,
        longitude: values[2].value,
    };

    var updates = {};
    updates['/locations/' + updateID] = postData;

    firebase.database().ref().update(updates);

    $("#update-modal").modal('hide');
});


// Remove Data
$("body").on('click', '.removeData', function () {
    var id = $(this).attr('data-id');
    $('body').find('.locations-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
});

$('.deleteMatchRecord').on('click', function () {
    var values = $(".locations-remove-record-model").serializeArray();
    var id = values[0].value;
    firebase.database().ref('locations/' + id).remove();
    $('body').find('.locations-remove-record-model').find("input").remove();
    $("#remove-modal").modal('hide');
});
$('.remove-data-from-delete-form').click(function () {
    $('body').find('.locations-remove-record-model').find("input").remove();
});





