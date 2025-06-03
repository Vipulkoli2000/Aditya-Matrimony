<!-- resources/views/pages/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Profile Page')

@section('sidebar')
    <div id="sidebar">
        <div class="offcanvas-header"> <!-- Hide on large screens -->
            <h5 class="offcanvas-title" id="sidebarLabel">Profile Details</h5>
            <button id="sidebarClose" class="btn btn-close  d-lg-none"></button> <!-- Close button -->
        </div>

        <div class="offcanvas-body">
            <ul class="list-group">
                <li class="list-group-item"> <a href="{{ route('user_profiles') }}">View Profile</a></li>
                <li class="list-group-item"><a href="#">Basic Details</a></li>
                <li class="list-group-item"><a href="#">Religious Details</a></li>
                <li class="list-group-item"><a href="#">Family Background</a></li>
                <li class="list-group-item"><a href="#">Astronomy Details</a></li>
                <li class="list-group-item"><a href="#">Educational Details</a></li>
                <li class="list-group-item"><a href="#">Occupational Details</a></li>
                <li class="list-group-item"><a href="#">Contact Details</a></li>
                <li class="list-group-item"><a href="#">Physical Health Details</a></li>
                <li class="list-group-item"><a href="#">About Life Partner</a></li>
                <li class="list-group-item"><a href="#">Pay Now</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <p>This is the profile page content.</p>
@endsection
