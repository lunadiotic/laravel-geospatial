@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body" id="mapid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<style>
    #mapid { min-height: 500px; }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script>
    var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }},
        {{ config('leaflet.map_center_longitude') }}],
        {{ config('leaflet.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    }).addTo(map);

    $.get('/api/location', function(locations) {
        L.geoJSON(locations,{
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function(layer) {
            return (`
                <div class="my-2">
                    <strong>Place Name</strong> :<br>${layer.feature.properties.name}
                </div>
                <div class="my-2">
                    <strong>Description</strong>:<br>${layer.feature.properties.name}
                </div>
                <div class="my-2">
                    <strong>Address</strong>:<br>${layer.feature.properties.address}
                </div>
            `);
        }).addTo(map);
        console.log(locations)
    })
    .fail(function() {
        alert("error")
    })
</script>
@endpush
