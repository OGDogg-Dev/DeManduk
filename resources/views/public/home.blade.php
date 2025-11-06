@extends('layouts.app')

@section('hero')
    @if (!empty($slides))
        <x-public.hero-carousel :slides="$slides" />
    @endif
@endsection

@section('content')
    <x-public.quick-nav :sections="$sections" />

    <x-public.about-section
        :paragraphs="$about['paragraphs'] ?? []"
        :image="$about['image'] ?? null"
    />

    @if (!empty($projects))
        <x-public.project-carousel :projects="$projects" />
    @endif

    @if (!empty($features))
        <x-public.feature-grid :features="$features" />
    @endif

    <x-public.pricing-overview :ticket-rows="$ticketRows" :facility-rows="$facilityRows" />
    <x-public.hours-summary :opening-rows="$openingRows" />
    <x-section id="map">
        <x-public.map-section
            :maps-url="$map['mapsUrl'] ?? null"
            :link-label="$map['linkLabel'] ?? null"
            :directions-url="$map['directionsUrl'] ?? null"
        />
    </x-section>

    <x-public.impact-overview :stats="$stats" :procedures="$procedures" />

    <x-public.sop-accordion :guides="$guides" :institutions="$institutions" />

    <x-public.cta-strip />
    <x-public.back-to-top />
@endsection
