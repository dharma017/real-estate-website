@extends('frontend.layouts.app')

@section('styles')
    <style>
        #map {
            height: 320px;
        }

        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .jssora106 {
            display: block;
            position: absolute;
            cursor: pointer;
        }

        .jssora106 .c {
            fill: #fff;
            opacity: .3;
        }

        .jssora106 .a {
            fill: none;
            stroke: #000;
            stroke-width: 350;
            stroke-miterlimit: 10;
        }

        .jssora106:hover .c {
            opacity: .5;
        }

        .jssora106:hover .a {
            opacity: .8;
        }

        .jssora106.jssora106dn .c {
            opacity: .2;
        }

        .jssora106.jssora106dn .a {
            opacity: 1;
        }

        .jssora106.jssora106ds {
            opacity: .3;
            pointer-events: none;
        }

        .jssort101 .p {
            position: absolute;
            top: 0;
            left: 0;
            box-sizing: border-box;
            background: #000;
        }

        .jssort101 .p .cv {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            z-index: 1;
        }

        .jssort101 .a {
            fill: none;
            stroke: #fff;
            stroke-width: 400;
            stroke-miterlimit: 10;
            visibility: hidden;
        }

        .jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {
            border: none;
            border-color: transparent;
        }

        .jssort101 .p:hover {
            padding: 2px;
        }

        .jssort101 .p:hover .cv {
            background-color: rgba(0, 0, 0, 6);
            opacity: .35;
        }

        .jssort101 .p:hover.pdn {
            padding: 0;
        }

        .jssort101 .p:hover.pdn .cv {
            border: 2px solid #fff;
            background: none;
            opacity: .35;
        }

        .jssort101 .pav .cv {
            border-color: #fff;
            opacity: .35;
        }

        .jssort101 .pav .a, .jssort101 .p:hover .a {
            visibility: visible;
        }

        .jssort101 .t {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            opacity: .6;
        }

        .jssort101 .pav .t, .jssort101 .p:hover .t {
            opacity: 1;
        }
    </style>
@endsection

@section('content')

    <!-- SINGLE PROPERTY SECTION -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col s12 m8">
                    <div class="single-title">
                        <h1 class="single-title">{{ $property->title }}</h1>
                    </div>

                    <div class="address m-b-30">
                        <i class="small material-icons left">place</i>
                        <span class="font-18">{{ $property->address }}</span>
                    </div>

                    @if($property->contact_name)
                    <div class="contact-person m-b-30">
                        <i class="small material-icons left">person</i>
                        <span class="font-18">{{ $property->contact_name }}</span>
                    </div>
                    @endif

                    @if($property->contact_number || $property->alt_contact_number)
                    <div class="contact-number m-b-30">
                        <i class="small material-icons left">phone</i>
                        <span class="font-18">{{ $property->contact_number }}@if($property->alt_contact_number), {{ $property->alt_contact_number }}@endif</span>
                    </div>
                    @endif

                     @if($property->alt_contact_number)
                    <!-- <div class="contact-number m-b-30">
                        <i class="small material-icons left">phone</i>
                        <span class="font-18">{{ $property->alt_contact_number }}</span>
                    </div> -->
                    @endif


                    <div>
                        @if($property->view_count) <span
                                class="btn btn-small disabled b-r-20 m-t-10">Views: {{ $property->view_count}} </span> @endif
                        @if($property->bedroom) <span
                                class="btn btn-small disabled b-r-20 m-t-10">Bedroom: {{ $property->bedroom}} </span> @endif
                        @if($property->bathroom)<span
                                class="btn btn-small disabled b-r-20 m-t-10">Bathroom: {{ $property->bathroom}} </span>@endif
                        @if($property->living)<span
                                class="btn btn-small disabled b-r-20 m-t-10">Living: {{ $property->living}} </span>@endif
                        @if($property->kitchen)<span
                                class="btn btn-small disabled b-r-20 m-t-10">Kitchen: {{ $property->kitchen}} </span>@endif
                        @if($property->store_rooms)<span
                                class="btn btn-small disabled b-r-20 m-t-10">Store Room: {{ $property->store_rooms}} </span>@endif
                        @if($property->floors)<span
                                class="btn btn-small disabled b-r-20 m-t-10">Floors: {{ $property->floors}} </span>@endif
                        @if($property->parking) <span
                                class="btn btn-small disabled b-r-20 m-t-10">Parking: {{ $property->parking}} </span>@endif
                        @if($property->area)<span
                                class="btn btn-small disabled b-r-20 m-t-10">Area: {{ $property->area}} </span>@endif
                        @if($property->land_area)<span
                                class="btn btn-small disabled b-r-20 m-t-10">Land Area: {{ $property->land_area}}</span>@endif
                    </div>
                </div>
                <div class="col s12 m4">
                    <div>
                        <h4 class="left w100">
                            <strong>{{@money_format_nep($property->price)}}</strong>
                        </h4>
                        <span class="left w100">({{@money_in_words($property->price)}})</span>
                            @if($property->available)
                                <button type="button" class="btn btn-small m-t-25 m-r-5 left disabled b-r-20">
                                    For {{ $property->purpose }}
                                </button>
                            @else
                                <button type="button" class="btn btn-small m-t-25 m-r-5 left b-r-20 red">
                                    Sold
                                </button>
                            @endif

                             @if(isset($property->negotiable))
                                <button type="button" class="btn btn-small m-t-25 left disabled b-r-20">{{ $property->negotiable == 1 ? 'Negotiable' : 'Fixed'}}</button>
                            @endif
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col s12 m8">

                    @if(!$property->gallery->isEmpty())
                        <div class="single-slider">
                            @include('pages.properties.slider')
                        </div>
                    @else
                        <div class="single-image">
                            @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                <img src="{{Storage::url('property/'.$property->image)}}" alt="{{$property->title}}"
                                     class="imgresponsive">
                            @endif
                        </div>
                    @endif

                    <div class="single-description p-15 m-b-15 border2 border-top-0">
                        {!! $property->description !!}
                    </div>

                    <div>
                        @if($property->amenities)
                            <ul class="collection with-header">
                                <li class="collection-header grey lighten-4"><h5 class="m-0">Amenities</h5></li>
                                @foreach($property->amenities as $amenity)
                                    <li class="collection-item">{{$amenity->name}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    @if($property->floor_plan)
                        <div class="card-no-box-shadow card">
                            <div class="p-15 grey lighten-4">
                                <h5 class="m-0">Floor Plan</h5>
                            </div>
                            <div class="card-image">
                                @if(Storage::disk('public')->exists('property/'.$property->floor_plan) && $property->floor_plan)
                                    <img src="{{Storage::url('property/'.$property->floor_plan)}}"
                                         alt="{{$property->title}}" class="imgresponsive">
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="card-no-box-shadow card">
                        <div class="p-15 grey lighten-4">
                            <h5 class="m-0">Location</h5>
                        </div>
                        <div class="card-image">
                            <!-- <div id="map"></div> -->
                            <iframe src="https://maps.google.com/maps?q=<?php echo $property->location_latitude; ?>, <?php echo $property->location_longitude; ?>&z=12&output=embed" width="100%" height="360" frameborder="0" style="border:0"></iframe>
                        </div>
                    </div>

                    @if($videoembed)
                        <div class="card-no-box-shadow card">
                            <div class="p-15 grey lighten-4">
                                <h5 class="m-0">Video</h5>
                            </div>
                            <div class="card-image center m-t-10">
                                {!! $videoembed !!}
                            </div>
                        </div>
                    @endif

                    <div class="card-no-box-shadow card">
                        <div class="p-15 grey lighten-4">
                            <h5 class="m-0">Near By</h5>
                        </div>
                        <div class="single-narebay p-15">
                            {!! $property->nearby !!}
                        </div>
                    </div>

                    {{--                    <div class="card-no-box-shadow card">--}}
                    {{--                        <div class="p-15 grey lighten-4">--}}
                    {{--                            <h5 class="m-0">--}}
                    {{--                                {{ $property->comments_count }} Comments--}}
                    {{--                                @auth--}}
                    {{--                                <div class="right" id="rateYo"></div>--}}
                    {{--                                @endauth--}}
                    {{--                            </h5>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="single-narebay p-15">--}}

                    {{--                            @foreach($property->comments as $comment)--}}

                    {{--                                @if($comment->parent_id == NULL)--}}
                    {{--                                    <div class="comment">--}}
                    {{--                                        <div class="author-image">--}}
                    {{--                                            <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="content">--}}
                    {{--                                            <div class="author-name">--}}
                    {{--                                                <strong>{{ $comment->users->name }}</strong>--}}
                    {{--                                                <span class="time">{{ $comment->created_at->diffForHumans() }}</span>--}}

                    {{--                                                @auth--}}
                    {{--                                                    <span id="commentreplay" class="right replay" data-commentid="{{ $comment->id }}">Replay</span>--}}
                    {{--                                                @endauth--}}

                    {{--                                            </div>--}}
                    {{--                                            <div class="author-comment">--}}
                    {{--                                                {{ $comment->body }}--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div id="procomment-{{$comment->id}}"></div>--}}
                    {{--                                    </div>--}}
                    {{--                                @endif--}}

                    {{--                                @foreach($comment->children as $commentchildren)--}}
                    {{--                                    <div class="comment children">--}}
                    {{--                                        <div class="author-image">--}}
                    {{--                                            <span style="background-image:url({{ Storage::url('users/'.$commentchildren->users->image) }});"></span>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="content">--}}
                    {{--                                            <div class="author-name">--}}
                    {{--                                                <strong>{{ $commentchildren->users->name }}</strong>--}}
                    {{--                                                <span class="time">{{ $commentchildren->created_at->diffForHumans() }}</span>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="author-comment">--}}
                    {{--                                                {{ $commentchildren->body }}--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                @endforeach--}}

                    {{--                            @endforeach--}}

                    {{--                            @auth--}}
                    {{--                                <div class="comment-box">--}}
                    {{--                                    <h6>Leave a comment</h6>--}}
                    {{--                                    <form action="{{ route('property.comment',$property->id) }}" method="POST">--}}
                    {{--                                        @csrf--}}
                    {{--                                        <input type="hidden" name="parent" value="0">--}}

                    {{--                                        <textarea name="body" class="box"></textarea>--}}
                    {{--                                        <input type="submit" class="btn indigo" value="Comment">--}}
                    {{--                                    </form>--}}
                    {{--                                </div>--}}
                    {{--                            @endauth--}}

                    {{--                            @guest --}}
                    {{--                                <div class="comment-login">--}}
                    {{--                                    <h6>Please Login to comment</h6>--}}
                    {{--                                    <a href="{{ route('login') }}" class="btn indigo">Login</a>--}}
                    {{--                                </div>--}}
                    {{--                            @endguest--}}
                    {{--                            --}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                </div>
                {{-- End ./COL M8 --}}

                <div class="col s12 m4">
                    <div class="clearfix">

{{--                                                <div>--}}
{{--                                                    <ul class="collection with-header m-t-0">--}}
{{--                                                        <li class="collection-header grey lighten-4">--}}
{{--                                                            <h5 class="m-0">Contact with Agent</h5>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="collection-item p-0">--}}
{{--                                                            @if($property->user)--}}
{{--                                                                <div class="card horizontal card-no-shadow">--}}
{{--                                                                    <div class="card-image p-l-10 agent-image">--}}
{{--                                                                        <img src="{{Storage::url('users/'.$property->user->image)}}"--}}
{{--                                                                             alt="{{ $property->user->username }}" class="imgresponsive">--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="card-stacked">--}}
{{--                                                                        <div class="p-l-10 p-r-10">--}}
{{--                                                                            <h5 class="m-t-b-0">{{ $property->user->name }}</h5>--}}
{{--                                                                            <strong>{{ $property->user->email }}</strong>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="p-l-10 p-r-10">--}}
{{--                                                                    <p>{{ $property->user->about }}</p>--}}
{{--                                                                    <a href="{{ route('agents.show',$property->agent_id) }}"--}}
{{--                                                                       class="profile-link">Profile</a>--}}
{{--                                                                </div>--}}
{{--                                                            @endif--}}
{{--                                                        </li>--}}

{{--                                                        <li class="collection agent-message">--}}
{{--                                                            <form class="agent-message-box" action="" method="POST">--}}
{{--                                                                @csrf--}}
{{--                                                                <input type="hidden" name="agent_id" value="{{ $property->user->id }}">--}}
{{--                                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">--}}
{{--                                                                <input type="hidden" name="property_id" value="{{ $property->id }}">--}}

{{--                                                                <div class="box">--}}
{{--                                                                    <input type="text" name="name" placeholder="Your Name">--}}
{{--                                                                </div>--}}
{{--                                                                <div class="box">--}}
{{--                                                                    <input type="email" name="email" placeholder="Your Email">--}}
{{--                                                                </div>--}}
{{--                                                                <div class="box">--}}
{{--                                                                    <input type="number" name="phone" placeholder="Your Phone">--}}
{{--                                                                </div>--}}
{{--                                                                <div class="box">--}}
{{--                                                                    <textarea name="message" placeholder="Your Msssage"></textarea>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="box">--}}
{{--                                                                    <button id="msgsubmitbtn" class="btn waves-effect waves-light w100 indigo"--}}
{{--                                                                            type="submit">--}}
{{--                                                                        SEND--}}
{{--                                                                        <i class="material-icons left">send</i>--}}
{{--                                                                    </button>--}}
{{--                                                                </div>--}}
{{--                                                            </form>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}

{{--                                                <div>--}}
{{--                                                    <ul class="collection with-header">--}}
{{--                                                        <li class="collection-header grey lighten-4">--}}
{{--                                                            <h5 class="m-0">City List</h5>--}}
{{--                                                        </li>--}}
{{--                                                        @foreach($cities as $city)--}}
{{--                                                            <li class="collection-item p-0">--}}
{{--                                                                <a class="city-list" href="{{ route('property.city',$city->city_slug) }}">--}}
{{--                                                                    <span>{{ $city->city }}</span>--}}
{{--                                                                </a>--}}
{{--                                                            </li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}


                        <div class="collection with-header  m-t-0">

                            <h2 class="sidebar-title">search property</h2>

                            <form class="sidebar-search" action="{{ route('search')}}" method="GET">

                                <div class="searchbar">
                                    <div class="input-field col s12">
                                        <input type="text" name="city" id="autocomplete-input-sidebar" class="autocomplete custominputbox" autocomplete="off">
                                        <label for="autocomplete-input-sidebar">Enter City or State</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <select name="type" class="browser-default">
                                            <option value="" disabled selected>Choose Type</option>
                                            <option value="bungalow">Bungalow</option>
                                            <option value="house">House</option>
                                            <option value="land">Land</option>
                                            <option value="rent">Rent</option>
                                            <option value="apartment">Apartment</option>
                                            <option value="colony">Colony</option>
                                            <option value="flat">Flat</option>
                                        </select>
                                    </div>

                                    <div class="input-field col s12">
                                        <select name="purpose" class="browser-default">
                                            <option value="" disabled selected>Choose Purpose</option>
                                            <option value="rent">Rent</option>
                                            <option value="sale">Sale</option>
                                            <option value="lease">Lease</option>
                                        </select>
                                    </div>

                                    {{--                            <div class="input-field col s12">--}}
                                    {{--                                <select name="bedroom" class="browser-default">--}}
                                    {{--                                    <option value="" disabled selected>Choose Bedroom</option>--}}
                                    {{--                                    @foreach($bedroomdistinct as $bedroom)--}}
                                    {{--                                        <option value="{{$bedroom->bedroom}}">{{$bedroom->bedroom}}</option>--}}
                                    {{--                                    @endforeach--}}
                                    {{--                                </select>--}}
                                    {{--                            </div>--}}

                                    {{--                            <div class="input-field col s12">--}}
                                    {{--                                <select name="bathroom" class="browser-default">--}}
                                    {{--                                    <option value="" disabled selected>Choose Bathroom</option>--}}
                                    {{--                                    @foreach($bathroomdistinct as $bathroom)--}}
                                    {{--                                        <option value="{{$bathroom->bathroom}}">{{$bathroom->bathroom}}</option>--}}
                                    {{--                                    @endforeach--}}
                                    {{--                                </select>--}}
                                    {{--                            </div>--}}

                                    <div class="input-field col s12">
                                        <input type="number" name="minprice" id="minprice" class="custominputbox">
                                        <label for="minprice">Min Price</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input type="number" name="maxprice" id="maxprice" class="custominputbox">
                                        <label for="maxprice">Max Price</label>
                                    </div>

                                    {{--                            <div class="input-field col s12">--}}
                                    {{--                                <input type="number" name="minarea" id="minarea" class="custominputbox">--}}
                                    {{--                                <label for="minarea">Floor Min Area</label>--}}
                                    {{--                            </div>--}}

                                    {{--                            <div class="input-field col s12">--}}
                                    {{--                                <input type="number" name="maxarea" id="maxarea" class="custominputbox">--}}
                                    {{--                                <label for="maxarea">Floor Max Area</label>--}}
                                    {{--                            </div>--}}

                                    <div class="input-field col s12">
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="featured">
                                                <span class="lever"></span>
                                                Featured
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <button class="btn btnsearch indigo" type="submit">
                                            <i class="material-icons">search</i>
                                            <span>SEARCH</span>
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div>
                            <ul class="collection with-header">
                                <li class="collection-header grey lighten-4">
                                    <h5 class="m-0">Related Properties</h5>
                                </li>
                                @foreach($relatedproperty as $property_related)
                                    <li class="collection-item p-0">
                                        <a href="{{ route('property.show',$property_related->slug) }}">
                                            <div class="card horizontal card-no-shadow m-0">
                                                @if($property_related->image)
                                                    <div class="card-image">
                                                        <img src="{{Storage::url('property/'.$property_related->image)}}"
                                                             alt="{{$property_related->title}}" class="imgresponsive">
                                                    </div>
                                                @endif
                                                <div class="card-stacked">
                                                    <div class="p-l-10 p-r-10 indigo-text">
                                                        <h6 title="{{$property_related->title}}">{{ str_limit( $property_related->title, 18 ) }}</h6>
                                                        <strong>{{@money_format_nep($property_related->price)}}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- RATING --}}
    @php
        $rating = ($rating == null) ? 0 : $rating;
    @endphp

@endsection

@section('scripts')

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // RATING
            $("#rateYo").rateYo({
                rating: <?php echo json_encode($rating); ?>,
                halfStar: true,
                starWidth: "26px"
            })
                .on("rateyo.set", function (e, data) {

                    var rating = data.rating;
                    var property_id = <?php echo json_encode($property->id); ?>;
                    var user_id = <?php echo json_encode(auth()->id()); ?>;

                    $.post("{{ route('property.rating') }}", {
                        rating: rating,
                        property_id: property_id,
                        user_id: user_id
                    }, function (data) {
                        if (data.rating.rating) {
                            M.toast({
                                html: 'Rating: ' + data.rating.rating + ' added successfully.',
                                classes: 'green darken-4'
                            })
                        }
                    });
                });


            // COMMENT
            $(document).on('click', '#commentreplay', function (e) {
                e.preventDefault();

                var commentid = $(this).data('commentid');

                $('#procomment-' + commentid).empty().append(
                    `<div class="comment-box">
                        <form action="{{ route('property.comment',$property->id) }}" method="POST">
                            @csrf
                        <input type="hidden" name="parent" value="1">
                        <input type="hidden" name="parent_id" value="` + commentid + `">

                            <textarea name="body" class="box" placeholder="Leave a comment"></textarea>
                            <input type="submit" class="btn indigo" value="Comment">
                        </form>
                    </div>`
                );
            });

            // MESSAGE
            $(document).on('submit', '.agent-message-box', function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = "{{ route('property.message') }}";
                var btn = $('#msgsubmitbtn');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    beforeSend: function () {
                        $(btn).addClass('disabled');
                        $(btn).empty().append('LOADING...<i class="material-icons left">rotate_right</i>');
                    },
                    success: function (data) {
                        if (data.message) {
                            M.toast({html: data.message, classes: 'green darken-4'})
                        }
                    },
                    error: function (xhr) {
                        M.toast({html: xhr.statusText, classes: 'red darken-4'})
                    },
                    complete: function () {
                        $('form.agent-message-box')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append('SEND<i class="material-icons left">send</i>');
                    },
                    dataType: 'json'
                });

            })
        })
    </script>

    <!-- <script src="{{ asset('frontend/js/jssor.slider.min.js') }}"></script>
    <script>
        jssor_1_slider_init = function () {

            var jssor_1_SlideshowTransitions = [
                {
                    $Duration: 1200,
                    x: 0.3,
                    $During: {$Left: [0.3, 0.7]},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: -0.3,
                    $SlideOut: true,
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: -0.3,
                    $During: {$Left: [0.3, 0.7]},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    $SlideOut: true,
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $During: {$Top: [0.3, 0.7]},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: -0.3,
                    $SlideOut: true,
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: -0.3,
                    $During: {$Top: [0.3, 0.7]},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $SlideOut: true,
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    $Cols: 2,
                    $During: {$Left: [0.3, 0.7]},
                    $ChessMode: {$Column: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    $Cols: 2,
                    $SlideOut: true,
                    $ChessMode: {$Column: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $Rows: 2,
                    $During: {$Top: [0.3, 0.7]},
                    $ChessMode: {$Row: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $Rows: 2,
                    $SlideOut: true,
                    $ChessMode: {$Row: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: 0.3,
                    $Cols: 2,
                    $During: {$Top: [0.3, 0.7]},
                    $ChessMode: {$Column: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    y: -0.3,
                    $Cols: 2,
                    $SlideOut: true,
                    $ChessMode: {$Column: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7]},
                    $ChessMode: {$Row: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: -0.3,
                    $Rows: 2,
                    $SlideOut: true,
                    $ChessMode: {$Row: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    y: 0.3,
                    $Cols: 2,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]},
                    $ChessMode: {$Column: 3, $Row: 12},
                    $Easing: {$Left: $Jease$.$InCubic, $Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    x: 0.3,
                    y: 0.3,
                    $Cols: 2,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]},
                    $SlideOut: true,
                    $ChessMode: {$Column: 3, $Row: 12},
                    $Easing: {$Left: $Jease$.$InCubic, $Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    $Delay: 20,
                    $Clip: 3,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    $Delay: 20,
                    $Clip: 3,
                    $SlideOut: true,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$OutCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    $Delay: 20,
                    $Clip: 12,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 1200,
                    $Delay: 20,
                    $Clip: 12,
                    $SlideOut: true,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$OutCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                }
            ];

            var jssor_1_options = {
                $AutoPlay: 1,
                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: jssor_1_SlideshowTransitions,
                    $TransitionsOrder: 1
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $SpacingX: 5,
                    $SpacingY: 5
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                } else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        };

        @if(!$property->gallery->isEmpty())
        jssor_1_slider_init();
        @endif

    </script> -->


    <!-- Initialize Swiper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.js" type="text/javascript"></script>
    <script>
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 4,
            // loop: true,
            // freeMode: true,
            // loopedSlides: 5, //looped slides should be the same
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 10,
            // loop:true,
            // loopedSlides: 5, //looped slides should be the same
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: galleryThumbs,
            },
        });
    </script>
    <!-- <script>
        function initMap() {
            var propLatLng = {
                lat: <?php //echo $property->location_latitude; ?>,
                lng: <?php //echo $property->location_longitude; ?>
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: propLatLng
            });

            var marker = new google.maps.Marker({
                position: propLatLng,
                map: map,
                title: '<?php //echo $property->title; ?>'
            });
        }
    </script> -->
    <!-- <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRLaJEjRudGCuEi1_pqC4n3hpVHIyJJZA&callback=initMap">
    </script> -->
@endsection