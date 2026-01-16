@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin Panel Fabi Abadi Travel')

@section('page-title', 'Dashboard Admin')

@section('content')
    <!-- Dashboard Section -->
    @include('admin.sections.dashboard')

    <!-- Users Section (Pendaftar Umroh) -->
    @include('admin.sections.users')

    <!-- Bookings Section -->
    @include('admin.sections.bookings')

    <!-- Packages Section -->
    @include('admin.sections.packages')

    <!-- Mutawifs Section -->
    @include('admin.sections.mutawwifs')

    <!-- Partners Section -->
    @include('admin.sections.partners')

    <!-- Galleries Section -->
    @include('admin.sections.galleries')
@endsection

