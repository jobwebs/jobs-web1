<div class="mdl-card__title">
    <h5 class="mdl-card__title-text">最热</h5>
</div>

<div class="mdl-card info-card">
    @foreach($array as $news)
        <div class="hot-news-body" data-content="{{$news->nid}}">
            <div class="hot-news-aside">
                <img src="{{asset('images/lamian.jpg')}}"/>
            </div>

            <div class="hot-news-content">
                <h6>[{{$news->quote}}] {{$news->title}}</h6>
            </div>
        </div>
    @endforeach
</div>
