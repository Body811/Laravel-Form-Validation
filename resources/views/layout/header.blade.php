<header>
    <nav class = "nav">
        <div class = logo>
            <a href=""> <h4>{{__('msg.Registration Form')}}</h4></a>
            </div>
                <ul class = "menu">
                    <li> <a href=""> {{__('msg.Home')}}</a> </li>
                    <li> <a href=""> {{__('msg.Feedback')}}</a> </li>
                    <li> <a href=""> {{__('msg.FAQ')}}  </a> </li>
                    <li> <a href=""> {{__('msg.Register')}}</a> </li>
                    <li> <a href=""> {{__('msg.login')}}</a> </li>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li> <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}</a> </li>
                    @endforeach

                </ul>
    </nav>
</header>
