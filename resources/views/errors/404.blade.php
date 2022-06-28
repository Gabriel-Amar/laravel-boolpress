@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Questo prodotto non esiste'))
<a href="admin/posts">Torna ai post</a>
