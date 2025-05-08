@extends('layouts.app')

@section('content')
    <h1>Choisis une histoire</h1>

    <ul>
        @foreach ($stories as $story)
            <li>
                @if ($story['id'] === 1)
                    <form method="POST" action="{{ route('story.start') }}">
                        @csrf
                        <input type="hidden" name="story_id" value="{{ $story['id'] }}">
                        <button type="submit">
                            {{ $story['title'] }} — {{ $story['description'] }}
                        </button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>

    <!-- Point de montage pour Vue.js -->
    <div id="vue-mount-point"></div>
@endsection
