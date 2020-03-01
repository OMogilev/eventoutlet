@extends('site.layout.index')

@section('content')
<header class="header-hero">
    <div class="container container-bg">
      <div class="header-hero__wrapper">
        <div class="header-hero__figure"></div>
        <div class="row">
          <div class="col-xl-8 offset-xl-2">
            <div class="header-hero__title">
              <span> Поиск свободных специалистов для вашего мероприятия со скидкой </span>
            </div>
            <div class="header-hero__subtitle"><span>Найдите специалиста для проекта в 2 клика</span></div>
            <search
                :specialities="{{ $specialities }}"
                start-date="{{ $startDate }}"
                end-date="{{ $endDate }}"
            ></search>
          </div>
        </div>
      </div>
    </div>
  </header>

<section id="whats" class="whats">
    <div class="container">
        <div class="whats-it">
            <div class="whats-it__head">
                <div class="row">
                    <div class="col-xl-8 offset-xl-2">
                        <div class="whats-it__title">
                            <span>Как работает Event Outlet?</span>
                        </div>
                        <div class="whats-it__subtitle">
                            <p>
                                Если ваше мероприятие в ближайшие 31 день, а кого-то из специалистов или площадку вы еще не нашли,
                                наш портал поможет вам! Вы сможете найти любого подрядчика на вашу дату со скидкой от 10% до 70%.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whats-it__count">
                <div class="row">
                    <!-- Item -->
                    <div class="col-xl-3 d-flex">
                        <div class="whats-it__block">
                            <div class="whats-it__block_wrapp">
                                <div class="whats-it__block_pic">
                                    <img src="/static/eventoutlet/dist/img/general/what.png" alt="" />
                                </div>
                                <div class="whats-it__block_title">
                                    <span>Кому нужен этот портал?</span>
                                </div>
                                <div class="whats-it__block_subtitle">
                                    <p>Если вам просто нужен специалист event-индустрии на конкретный день</p>
                                </div>
                                <div class="whats-it__block_button">
                                    <a href="{{ route('site.about') }}" class="thin-rectangle-btn rectangle-btn-border rectangle-btn-border-green">
                                        <span>Подробнее</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 d-flex">
                        <div class="whats-it__block">
                            <div class="whats-it__block_wrapp">
                                <div class="whats-it__block_pic">
                                    <img src="/static/eventoutlet/dist/img/general/what-2.png" alt="" />
                                </div>
                                <div class="whats-it__block_title">
                                    <span>Как это работает?</span>
                                </div>
                                <div class="whats-it__block_subtitle">
                                    <p>Если вам просто нужен специалист event-индустрии на конкретный день</p>
                                </div>
                                <div class="whats-it__block_button">
                                    <a href="{{ route('site.about') }}" class="thin-rectangle-btn rectangle-btn-border rectangle-btn-border-green">
                                        <span>Подробнее</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 d-flex">
                        <div class="whats-it__block">
                            <div class="whats-it__block_wrapp">
                                <div class="whats-it__block_pic">
                                    <img src="/static/eventoutlet/dist/img/general/what-3.png" alt="" />
                                </div>
                                <div class="whats-it__block_title"><span>Как найти специалиста?</span></div>
                                <div class="whats-it__block_subtitle">
                                    <p>Если вам просто нужен специалист event-индустрии на конкретный день</p>
                                </div>
                                <div class="whats-it__block_button">
                                    <a href="{{ route('site.about') }}" class="thin-rectangle-btn rectangle-btn-border rectangle-btn-border-green">
                                        <span>Подробнее</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 d-flex">
                        <div class="whats-it__block">
                            <div class="whats-it__block_wrapp">
                                <div class="whats-it__block_pic">
                                    <img src="/static/eventoutlet/dist/img/general/what-4.png" alt="" />
                                </div>
                                <div class="whats-it__block_title">
                                    <span>Что вы получаете?</span>
                                </div>
                                <div class="whats-it__block_subtitle">
                                    <p>Если вам просто нужен специалист event-индустрии на конкретный день</p>
                                </div>
                                <div class="whats-it__block_button">
                                    <a href="{{ route('site.about') }}" class="thin-rectangle-btn rectangle-btn-border rectangle-btn-border-green">
                                        <span>Подробнее</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="whats-it__benefits">
                <div class="row">
                    <!-- Item -->
                    <div class="col-xl-4 d-flex">
                        <div class="whats-it__benefit">
                            <div class="whats-it__benefit_wrapper">
                                <div class="whats-it__benefit_head">
                                    <div class="clock-svg svg"></div>
                                    <span>Актуальность</span>
                                </div>
                                <div class="whats-it__benefit_subtitle">
                                    <p>
                                        Всегда актуальные предложения по самой низкой цене. Новые предложения появляются каждый день
                                    </p>
                                </div>
                                <div class="whats-it__benefit_button">
                                    <a href="{{ route('site.offers.index') }}" class="benefit-btn">
                                        <span>Смотреть предложения</span>
                                        <div class="long-arrow-svg"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-4 d-flex">
                        <div class="whats-it__benefit">
                            <div class="whats-it__benefit_wrapper">
                                <div class="whats-it__benefit_head">
                                    <div class="thumble-svg svg"></div>
                                    <span>Без посредников</span>
                                </div>
                                <div class="whats-it__benefit_subtitle">
                                    <p>Напрямую связываетесь со специалистом через популярные мессенджеры. Без посредников</p>
                                </div>
                                <div class="whats-it__benefit_button">
                                    <a href="{{ route('site.about') }}" class="benefit-btn">
                                        <span>Как работает сервис?</span>
                                        <div class="long-arrow-svg"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-4 d-flex">
                        <div class="whats-it__benefit">
                            <div class="whats-it__benefit_wrapper">
                                <div class="whats-it__benefit_head">
                                    <div class="letter-svg svg"></div>
                                    <span>Обновления</span>
                                </div>
                                <div class="whats-it__benefit_subtitle">
                                    <p>
                                        Если не нашли сегодня то, что вам надо, заходите завтра! Новые предложения появляются каждый
                                        день, не упустите самое привлекательное
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="whats-it__benefits_button">
                    <a href="{{ route('site.offers.index') }}" class="benefits-btn yellow">
                        <span>Подобрать исполнителя</span>
                        <div class="full-arrow-svg"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="finda" id="finda">
    <div class="container">
        <div class="finda__head">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="whats-it__title">
                        <span>Поиск актуальных предложений на портале Event Outlet со скидкой</span>
                    </div>
                </div>
            </div>
            <div class="finda__wrapper">
                <img src="/static/eventoutlet/dist/img/general/anim.png" alt="" />
            </div>
            <div class="finda__button">
                <a href="{{ route('site.offers.index') }}" class="benefits-btn red-border">
                    <span>Подобрать исполнителя</span>
                    <div class="full-arrow-svg"></div>
                </a>
            </div>
        </div>
    </div>
</section>
<section id="profitable" class="profitable">
    <div class="profitable__f-figure" style="background-image: url(./img/general/.png);"></div>
    <div class="profitable__s-figure" style="background-image: url(./img/general/.png);"></div>
    <div class="container">
        <div class="profitable__head">
            <div class="row">
                <div class="col-xl-9 offset-xl-2">
                    <div class="whats-it__title"><span>Самые выгодные предложения каждый день</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-7 offset-xl-3">
                    <div class="whats-it__subtitle">
                        <p>
                            Каждый день наш каталог специалистов пополняется новыми профессионалами и скидками, не пропустите)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="profitable-cards" class="profitable-cards">
    <div class="container">
        <div class="catalog__wrapper">
            <div class="container">
                <div class="row">
                    @foreach($users as $user)
                        @include('site.components.algo.index', ['user' => $user])
                    @endforeach
                </div>
            </div>
            <div class="catalog-pagination">
                <div class="catalog-pagination__wrapper">
                    <a href="{{ route('site.offers.index') }}" class="almost-square-btn rectangle-btn-border-green"><span>Перейти к каталогу</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
