@props(['status'])

@php
    $label = $status ? __('Active') : __('Inactive');
@endphp

<x-badge flat {{ $status ? 'positive' : 'negative' }} label="{{ $label }}" />
