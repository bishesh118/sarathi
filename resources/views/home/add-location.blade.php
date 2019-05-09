<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sarathi</title>

    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}">
    <script src="http://maps.google.com/maps/api/js?sensor=false"
            type="text/javascript"></script>
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"--}}
    {{--integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}

    <style>
        .card {
            margin-top: 100px;
        }

        .card-header {
            background-color: dodgerblue;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="card card-default">

                <div class="card-header">
                    <div class="row">

                        <div class="col-md-10">
                            <h4 style="text-align: center">Add Location</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="addLocation" class="" method="POST" action="">
                        <div class="form-group">
                            <label for="location" class="col-md-12 col-form-label">Location</label>

                            <div class="col-md-12">
                                <input id="location" type="text" class="form-control" name="location" value=""
                                       required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="latitude" class="col-md-12 col-form-label">Latitude</label>

                            <div class="col-md-12">
                                <input id="latitude" type="text" class="form-control" name="latitude" value=""
                                       required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="longitude" class="col-md-12 col-form-label">Longitude</label>

                            <div class="col-md-12">
                                <input id="longitude" type="text" class="form-control" name="longitude" value=""
                                       required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-3">
                                <button type="button" class="btn btn-success btn-block desabled" id="submitLocation">
                                    Submit
                                </button>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-md-12">
                    <a class="btn btn-primary btn-block desabled" href="{{route('view-map')}}">View Map</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 style="text-align: center">View All Locations</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Location</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th width="180" class="text-center">Action</th>
                        </tr>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">


        </div>
    </div>
</div>

<!-- Delete Model -->
<form action="" method="POST" class="locations-remove-record-model">
    <div id="remove-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete Record</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <h4>You Want You Sure Delete This Record?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteMatchRecord">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Update Model -->
<form action="" method="POST" class="locations-update-record-model form-horizontal">
    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Update Record</h4>
                    <button type="button" class="close update-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect update-data-from-delete-form"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-success waves-effect waves-light updateUserRecord">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{url('js/jquery.js')}}"></script>
<script src="{{url('js/popper.js')}}"></script>
<script src="{{url('js/bootstrap.js')}}"></script>
<script src="{{url('js/firebase.js')}}"></script>
<script src="{{ url('/js/main.js') }}"></script>
</body>
</html>