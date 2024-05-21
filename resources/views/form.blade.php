@extends("layout.master")

@section('title','Registration form')

@section('content')
<link rel="stylesheet" href="{{ asset('assets\css\form.css') }}">
<div id="blur">
        <div class="registeration-container">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
            <div class="header">{{__('msg.Registration Form')}}</div>
            <form action="{{route('store')}}" id="form" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-container">
                    <div class="form-group">
                        <label for="full-name">{{__('msg.Full Name')}} <span>*</span></label><br>
                        <input type="text" id="full-name" name="fullName" placeholder='{{__('msg.Enter')}}{{__('msg.Full Name')}}' value="{{ old('fullName') }}">
                        @error('fullName')
                        <small class="error">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="user-name">{{__('msg.Username')}} <span>*</span></label><br>
                        <input type="text" id="user-name" name="username" placeholder='{{__('msg.Enter')}}{{__('msg.Username')}}' value="{{ old('username') }}">
                        @error('username')
                        <small class="error">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone-num">{{__('msg.Phone Number')}} <span>*</span></label><br>
                        <input type="tel" id="phone-num" name="phone" placeholder='{{__('msg.Enter')}}{{__('msg.Phone Number')}}' value="{{ old('phone') }}">
                        @error('phone')
                        <small class="error">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{__('msg.Password')}} <span>*</span></label><br>
                        <input type="password" id="password" name="password" placeholder='{{__('msg.Password')}}'>
                        @error('password')
                        <small class="error">{!! $message !!}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">{{__('msg.Confirm Password')}} <span>*</span></label><br>
                        <input type="password" id="confirm-password" name="password_confirmation" placeholder='{{__('msg.Confirm Password')}}'>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">{{__('msg.Email')}} <span>*</span></label><br>
                        <input type="text" id="email" name="email" placeholder='{{__('msg.Enter')}}{{__('msg.Email')}}' value="{{ old('email') }}">
                        @error('email')
                        <small class="error">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">{{__('msg.Address')}} <span>*</span></label><br>
                        <input type="text" id="address" name="address" placeholder='{{__('msg.Enter')}}{{__('msg.Address')}}' value="{{ old('address') }}">
                        @error('address')
                        <small class="error">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birthdate">{{__('msg.Birthdate')}} <span>*</span></label><br>
                        <div class="birth-date">
                            <input type="date" id="birthdate" name="birthdate" placeholder="{{__('msg.Enter')}}{{__('msg.Birthdate')}}" value="{{ old('birthdate') }}">
                            <button type="button" class="api-check" onclick="toggle()">{{__('msg.Check')}}</button>
                            @error('birthdate')
                            <small class="error">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group image">
                        <label for="image-upload">{{__('msg.Upload Profile Photo')}} <span>*</span></label><br>
                        <input type="file" id="image-upload" name="imageName" style = " border: none;" accept="image/jpeg, image/png, image/jpg" >
                        @error('imageName')
                        <small class="error">{{$message}}</small>
                        @enderror
                    </div>

                </div>
                <div class="submit">
                    <input type="submit" value={{__('msg.Register')}}>
                </div>

            </form>
        </div>
    </div>
    <div class="popup-container">
        <div class="close-btn" onclick="toggle()">&times;</div>
        <h1>{{__('msg.Actors With the Same Age as You')}}</h1>
        <div class="popup-text"></div>
    </div>




<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".api-check").click(function() {
    var date = document.getElementById("birthdate");
    var selectedDate = new Date(date.value);
    var day = selectedDate.getDate();
    var month = selectedDate.getMonth() + 1;

    $.ajax({
        url: '{{route("actors")}}',
        type: "POST",
        data:{
            month: month,
            day: day
        },
        success: function(response) {
            var actorNames = JSON.parse(response);

            var actorNamesHtml = "";

            console.log(actorNames)

            for (var i = 0; i < actorNames.length; i += 3) {
                var group = actorNames.slice(i, i + 3);
                actorNamesHtml += "<p>" + group.join(" - ") + "</p>";
            }

            $(".popup-text").html(actorNamesHtml);

        },
        error: function(jqXHR, textStatus, errorThrown,response) {
        }
      });

    });





    function toggle() {
        document.getElementById("blur").classList.toggle("active");
        document.querySelector(".popup-container").classList.toggle("popup-container-show");
    }

    window.addEventListener('scroll', function () {
        let header = document.querySelector('nav');
        let windowPosition = window.scrollY > 0;
        header.classList.toggle('scrolled-nav', windowPosition);
    });


</script>
@endsection('content')
