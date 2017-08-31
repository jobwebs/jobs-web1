<div class="mdl-card__title">
    <h5 class="mdl-card__title-text">最热</h5>
</div>

<div class="mdl-card info-card">
    @foreach($array as $news)
        <div class="hot-news-body">
            <div class="hot-news-aside">
                <img src="{{asset('images/lamian.jpg')}}"/>
            </div>

            <div class="hot-news-content">
                <h6>兰州拉面进军日本，和风设计唤醒舌尖上的味蕾</h6>
            </div>
        </div>
    @endforeach
</div>
