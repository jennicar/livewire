@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'Not found'))
