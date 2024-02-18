@extends('client.layouts.app')
@section('title')
    @lang('app.app-name') - {{ $news->getName() }}
@endsection
@section('content')
    <div class="container-xl py-4">
        <div class="text-center py-3">
            <img src="{{ asset('storage/img/news/' . $news->image) }}" alt="" class="img-fluid">
        </div>
        <div class="py-3">
            {{ $news->created_at->format('d F, Y') }}
        </div>
        <div class="h3">
            {{ $news->getName() }}
        </div>
        @php
            $text = $news->getDescription();
            $length = strlen($text);
            $halfLength = ceil($length / 2);

            // Find the last space before the halfway point
            $lastSpace = strrpos(substr($text, 0, $halfLength), ' ');

            // If a space is found, split the string there, otherwise, use the original halfway point
            $splitPoint = $lastSpace !== false ? $lastSpace : $halfLength;

            $firstHalfOfText = substr($text, 0, $splitPoint);
            $secondHalfOfText = substr($text, $splitPoint);
        @endphp

        <div class="row row-cols-1 row-cols-lg-2">
            <div class="h5 col-12 col-lg-6" style="line-height: 30px;">
                <p>
                    {!! $firstHalfOfText !!}
                </p>
            </div>
            <div class="h5 col-12 col-lg-6" style="line-height: 30px;">
                <p>
                    {!! $secondHalfOfText !!}
                </p>
            </div>
        </div>

    </div>
@endsection