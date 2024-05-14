@extends($activeTemplate . 'layouts.app')
@section('panel')
  <!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <title>Bitrader - Professional Multipurpose HTML Template for Your Crypto, Forex, and Stocks Trading Business </title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Sites meta Data -->
  <meta name="application-name"
    content="Bitrader - Professional Multipurpose HTML Template for Your Crypto, Forex, and Stocks Trading Business">
  <meta name="author" content="thetork">
  <meta name="keywords" content="Bitrader, Crypto, Forex, and Stocks Trading Business">
  <meta name="description"
    content="Experience the power of Bitrader, the ultimate HTML template designed to transform your trading business. With its sleek design and advanced features, Bitrader empowers you to showcase your expertise, engage clients, and dominate the markets. Elevate your online presence and unlock new trading possibilities with Bitrader.">

  <!-- OG meta data -->
  <meta property="og:description"
    content="Welcome to Bitrader, the game-changing HTML template meticulously crafted to revolutionize your trading business. With its sleek and modern design, Bitrader provides a cutting-edge platform to showcase your expertise, attract clients, and stay ahead in the competitive trading markets.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="assets/images/og.png">



  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/aos.css">
  <link rel="stylesheet" href="assets/css/all.min.css">

  <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">



  <!-- main css for template -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <!-- ===============>> Preloader start here <<================= -->
  <div class="preloader">
    <img src="assets/images/logo/preloader.png" alt="preloader icon">
  </div>
  <!-- ===============>> Preloader end here <<================= -->



  <!-- ===============>> light&dark switch start here <<================= -->
  <div class="lightdark-switch d-none">
    <span class="dark-btn" id="btnSwitch"><img src="assets/images/icon/moon.svg" alt="light-dark-switchbtn"
        class="swtich-icon"></span>
  </div>
  <!-- ===============>> light&dark switch start here <<================= -->





  <!-- ===============>> Header section start here <<================= -->
  <header class="header-section header-section--style1">
    <div class="header-bottom">
      <div class="container">
        <div class="header-wrapper">
          <div class="logo">
            <a href="/">
              <img class="dark" src="assets/images/logo/logo.png" alt="logo">
            </a>
          </div>
          <div class="menu-area">
            <ul class="menu menu--style1">
              <li>
                <a href="/">Главная</a>
              </li>
			  <li>
                <a href="#about">О компании</a>
              </li>
			  <li>
                <a href="#invest">Инвестиции</a>
              </li>
			  <li>
                <a href="#partner">Партнерство</a>
              </li>
              <li>
                <a href="#0">Помощь</a>
                <ul class="submenu">
                  <li><a href="#faq">Частые вопросы</a></li>
				  <li><a href="#how">Как начать?</a></li>
				  <li><a href="/contact">Контакты</a></li>
                </ul>
              </li>

            </ul>

          </div>
          <div class="header-action">
            <div class="menu-area">
              <div class="header-btn">
                <a href="/user/login" class="trk-btn trk-btn--border trk-btn--primary">
                  <span>Кабинет</span>
                </a>
              </div>

              <!-- toggle icons -->
              <div class="header-bar d-lg-none header-bar--style1">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- ===============>> Header section end here <<================= -->





  <!-- ===============>> Banner section start here <<================= -->
  <section class="banner banner--style3">
    <div class="banner__bg">
      <div class="banner__bg-element">
        <img src="assets/images/bg/1.png" alt="section-bg-element">
      </div>
    </div>
    <div class="container">
      <div class="banner__wrapper">
        <div class="row gy-5 gx-4 align-items-end">
          <div class="col-lg-5 col-md-5">
            <div class="banner__content" data-aos="fade-right" data-aos-duration="1000">
              <div class="banner__content-coin banner__content-coin--style2">
                <img src="assets/images/banner/home3/2.png" alt="coin icon">
              </div>
              <h1 class="banner__content-heading">Получайте максимальный инвестиционный доход</h1>
              <p class="banner__content-moto">Любой желающий может получать доход от криптовалютного рынка в кратчайшие сроки, без рисков и с максимальной выгодой.
              </p>
              <div class="banner__btn-group btn-group">
                <a href="/user/register" class="trk-btn trk-btn--primary">Регистрация</a>

                <a href="/user/login" class="trk-btn trk-btn--secondary2">Вход</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="banner__thumb">
              <img src="assets/images/banner/home3/1.png" alt="banner-thumb" class="dark">
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="banner__counter">
              <div class="banner__counter-inner">
                  <div class="banner__counter-item">
                      @php
                          $setting = \App\Models\GeneralSetting::first();
                            $val = $setting ? $setting->start_of_project : null;
                      @endphp
                      <h4> <span class="">{{\Illuminate\Support\Carbon::now()->diffInDays($val)}} дня
                      </h4>
                      <p>Старт проекта</p>
                  </div>
                <div class="banner__counter-item">
                  <h4> <span class="purecounter" data-purecounter-start="0" data-purecounter-end="10">10</span> Дней
                  </h4>
                  <p>Работы</p>
                </div>
                <div class="banner__counter-item">
                  <h4> <span class="purecounter" data-purecounter-start="0" data-purecounter-end="2444">2444</span> Чел.
                  </h4>
                  <p>Клиентов</p>
                </div>
                <div class="banner__counter-item">
                  <h4> <span class="purecounter" data-purecounter-start="0" data-purecounter-end="25000">25000</span> $
                  </h4>
                  <p>Торговый оборот</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="banner__shape">
      <span class="banner__shape-item banner__shape-item--3"><img src="assets/images/banner/shape/1.png"
          alt="shape icon"></span>
      <span class="banner__shape-item banner__shape-item--4"><img src="assets/images/banner/shape/2.png"
          alt="shape icon"></span>
    </div>

  </section>
  <!-- ===============>> Banner section end here <<================= -->



  <!-- ===============>> feature section start here <<================= -->
  <section class="feature feature--style2 padding-bottom padding-top feature-bg-color bg--cover"
    style="background-image:url(assets/images/feature/home3/bg.png)">
    <div class="section-header section-header--style3 section-header--max57">
      <h2 class="mb-15 mt-minus-5">Наши преиимущества</h2>
      <p>Наши основные конкурентные и уникальные качества которые мы даем нашим клиентам.
      </p>
    </div>
    <div class="container">
      <div class="feature__wrapper">
        <div class="row g-4 align-items-center">
          <div class="col-sm-6 col-lg-3">
            <div class="feature__item" data-aos="fade-up" data-aos-duration="800">
              <div class="feature__item-inner text-center">
                <div class="feature__item-thumb">
                  <img class="dark" src="assets/images/feature/home3/1.png" alt="feature-item-icon">
                </div>
                <div class="feature__item-content">
                  <h5> Online </h5>
                  <p>Real-time data is like having a magic crystal ball that tells you what's happening now.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="feature__item" data-aos="fade-up" data-aos-duration="800">
              <div class="feature__item-inner text-center">
                <div class="feature__item-thumb">
                  <img class="dark" src="assets/images/feature/home3/2.png" alt="feature-item-icon">
                </div>
                <div class="feature__item-content">
                  <h5> Поддержка</h5>
                  <p>Hey there! How can I help? Just shoot me a message and I'll get back to you ASAP!</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="feature__item" data-aos="fade-up" data-aos-duration="800">
              <div class="feature__item-inner text-center">
                <div class="feature__item-thumb">
                  <img class="dark" src="assets/images/feature/home3/3.png" alt="feature-item-icon">
                </div>
                <div class="feature__item-content">
                  <h5> Надежность </h5>
                  <p>Looks like we've got higher security now, better make sure we have our IDs with us.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="feature__item" data-aos="fade-up" data-aos-duration="800">
              <div class="feature__item-inner text-center">
                <div class="feature__item-thumb">
                  <img class="dark" src="assets/images/feature/home3/1.png" alt="feature-item-icon">
                </div>
                <div class="feature__item-content">
                  <h5>Высокий доход</h5>
                  <p>I heard we're lowering commissions. That sucks, but at least it's not my fault sure.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="feature__shape">
      <span class="feature__shape-item feature__shape-item--1"><img src="assets/images/feature/home3/5.png"
          alt="shape-icon"></span>
    </div>
  </section>
  <!-- ===============>> feature section end here <<================= -->




  <!-- ===============>> About section start here <<================= -->
  <section class="about about--style3 padding-top padding-bottom " id="about">
    <div class="container">
      <div class="about__wrapper">
        <div class="row gx-5  gy-4 gy-sm-0  align-items-center">
          <div class="col-lg-6">
            <div class="about__thumb pe-lg-5" data-aos="fade-right" data-aos-duration="800">
              <div class="about__thumb-inner">
                <div class="about__thumb-image floating-content">
                  <img class="dark" src="assets/images/about/1.png" alt="about-image">
                  <div class="floating-content__top-left">
                    <div class="floating-content__item">
                      <h3> <span class="purecounter" data-purecounter-start="0" data-purecounter-end="10">30</span>
                        Лет
                      </h3>
                      <p>Успешной работы</p>
                    </div>
                  </div>
                  <div class="floating-content__bottom-right">
                    <div class="floating-content__item">
                      <h3> <span class="purecounter" data-purecounter-start="0" data-purecounter-end="250000">250 000</span>
                      </h3>
                      <p>Довольных клиентов</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about__content" data-aos="fade-left" data-aos-duration="800">
              <div class="about__content-inner">
                <h2>Компания <span>Lotos Capital LTD</span> ахуевшая компания </h2>

                <p class="mb-0">Привет привет привет </p>
                <a href="/user/register" class="trk-btn trk-btn--border trk-btn--primary">Регистрация </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-5 mt-100">
          <div class="col-md-6">
            <div class="about__content" data-aos="fade-right" data-aos-duration="800">
              <h2>Надежнейшая компания</h2>
              <ul>
                <li><span><img src="assets/images/about/home3/check.png" alt="check"></span> Официальная регистрация</li>
                <li><span><img src="assets/images/about/home3/check.png" alt="check"></span> Быстрый стабильные выплаты</li>
                <li><span><img src="assets/images/about/home3/check.png" alt="check"></span> The Experts Behind Your
                  Success</li>
                <li><span><img src="assets/images/about/home3/check.png" alt="check"></span> Empowering Traders
                  Worldwide</li>
              </ul>
              <a href="/user/register" class="trk-btn trk-btn--border trk-btn--primary">Регистрация</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="about__thumb" data-aos="fade-left" data-aos-duration="800">
              <div class="about__thumb-inner">
                <div class="about__thumb-image text-center floating-content">
                  <img class="dark" src="assets/images/about/home3/2.png" alt="about-image">
                  <div class="floating-content__top-left floating-content__top-left--style2">
                    <div class="floating-content__item floating-content__item--style5">
                      <h3> <span class="purecounter" data-purecounter-start="0" data-purecounter-end="90"></span>%
                      </h3>
                      <p>Процент от вклада</p>

                      <div class="progress">
                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                          aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===============>> About section start here <<================= -->




  <!-- ===============>> Service section start here <<================= -->
  <section class="service padding-top padding-bottom bg-color-7" id="how">
    <div class="section-header section-header--max50">
      <h2 class="mb-15 mt-minus-5"><span class="style2">Как начать </span>Зарабатывать</h2>
      <p>В 3 простых шага!</p>
    </div>
    <div class="container">
      <div class="service__wrapper">
        <div class="row g-4 align-items-center">
          <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="800">
              <div class="service__item-inner text-center">
                <div class="service__thumb mb-30">
                  <div class="service__thumb-inner">
                    <img class="dark" src="assets/images/service/4.png" alt="service-icon">
                  </div>
                </div>
                <div class="service__content">
                  <h5 class="mb-15"> <a class="stretched-link" href="service-details.html">Регистрация</a> </h5>
                  <p class="mb-0">A social assistant that's flexible can accommodate your schedule and needs, making
                    life easier.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="1000">
              <div class="service__item-inner text-center">
                <div class="service__thumb mb-30">
                  <div class="service__thumb-inner">
                    <img class="dark" src="assets/images/service/5.png" alt="service-icon">
                  </div>
                </div>
                <div class="service__content">
                  <h5 class="mb-15"> <a class="stretched-link" href="service-details.html"> Депозит</a> </h5>
                  <p class="mb-0">Modules transform smart trading by automating processes and improving decision-making.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="1200">
              <div class="service__item-inner text-center">
                <div class="service__thumb mb-30">
                  <div class="service__thumb-inner">
                    <img class="dark" src="assets/images/service/3.png" alt="service-icon">
                  </div>
                </div>
                <div class="service__content">
                  <h5 class="mb-15"> <a class="stretched-link" href="service-details.html">Прибыль</a> </h5>
                  <p class="mb-0">There, it's me, your friendly neighborhood reporter's news analyst processes and
                    improving</p>
                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
    <div class="service__shape">
      <span class="service__shape-item service__shape-item--2"> <img src="assets/images/icon/shape/1.png"
          alt="shape-icon"></span>
      <span class="service__shape-item service__shape-item--3"> <img src="assets/images/icon/shape/2.png"
          alt="shape-icon">
      </span>
    </div>

  </section>
  <!-- ===============>> Service section start here <<================= -->





  <!-- ===============>> Pricing section start here <<================= -->
  <section class="pricing padding-top padding-bottom bg--cover"
    style="background-image:url(assets/images/pricing/bg.png)" id="invest">
    <div class="section-header section-header--max50">
      <h2 class="mb-15 mt-minus-5"> <span>инвестиционные  </span>условия</h2>
      <p>Короткий срок вклада всего на 24 часа, обеспечит Вас прибылью до 50% за сутки!</p>
    </div>
    <div class="container">
      <div class="pricing__wrapper">
        <div class="row g-4 align-items-center">
          <div class="col-md-6 col-lg-4">
            <div class="pricing__item" data-aos="fade-right" data-aos-duration="1000">
              <div class="pricing__item-inner">
                <div class="pricing__item-content">

                  <!-- pricing top part -->
                  <div class="pricing__item-top">
                    <h6 class="mb-15">Basic</h6>
                    <h3 class="mb-25">15<span>%</span> </h3>
                  </div>

                  <!-- pricing middle part -->
                  <div class="pricing__item-middle">
                    <ul class="pricing__list">
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Вклад от 300 - 4 999 ₽</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Срок 24 часа</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        24/7 technical support</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Personal training</li>
                    </ul>

                  </div>
<script type="text/javascript">
        function calcs()
        {
      var counts = document.getElementById("counts"); // 15%

            prices = parseInt(counts.value) / 100 * 115;
            results.innerHTML = prices; // 15%
        }
</script>
                                      <body>

        Сумма вклада
        <input
          type="number"
          class="counts"
          min="0"
          data-recovery="0"
          data-min="300"
          data-max="3999"
          data-days="1"
          data-perc="15"
          id="counts"
          value="300"
          onchange="calcs()"
        />

        <div class="input-notice">"минимальная максимальная сумма согласно диапазону"</div>
        <div>Вы получите: <span
            class="result"
            id="results"
          >0</span></div>
    </body>
                  <!-- pricing bottom part -->
                  <div class="pricing__item-bottom">
                    <a href="signup.html" class="trk-btn trk-btn--outline">Инвестировать</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="pricing__item " data-aos="fade-up" data-aos-duration="1000">
              <div class="pricing__item-inner active">
                <div class="pricing__item-content">

                  <!-- pricing top part -->
                  <div class="pricing__item-top">
                    <h6 class="mb-15">standard</h6>
                    <h3 class="mb-25">30<span>%</span> </h3>
                  </div>

                  <!-- pricing middle part -->
                  <div class="pricing__item-middle">
                    <ul class="pricing__list">
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Вклад от 5 000 - 9 999 ₽</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Срок 24 часа</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        24/7 technical support</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Personal training</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Business analysis</li>
                    </ul>

                  </div>
<script type="text/javascript">
        function calc() {
            //получаем ссылку на элемент input (Кол-во вариантов)
            var count = document.getElementById("count");
            //получаем ссылку на элемент span, в него будем писать стоимость дизайна
            var result = document.getElementById("result");

            price = parseInt(count.value) * 1.3;

            result.innerHTML = price;
        }

</script>
    </head>
    <body>

     Сумма вклада <input type="number" class="counts"  min="0" data-recovery="1" data-min="4000" data-max="9999"
      data-days="2" data-perc="30"
      id="counts" value="400" onchange="calcs()" />
      <div class="input-notice">"минимальная максимальная сумма согласно диапазону"</div>

      <div>Вы получите: <span class="result" id="results">0</span></div>
    </body>
                  <!-- pricing bottom part -->
                  <div class="pricing__item-bottom">
                    <a href="signup.html" class="trk-btn trk-btn--outline active">Инвестировать</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="pricing__item" data-aos="fade-left" data-aos-duration="1000">
              <div class="pricing__item-inner">
                <div class="pricing__item-content">

                  <!-- pricing top part -->
                  <div class="pricing__item-top">
                    <h6 class="mb-15">premium</h6>
                    <h3 class="mb-25">50<span>%</span> </h3>
                  </div>

                  <!-- pricing middle part -->
                  <div class="pricing__item-middle">
                    <ul class="pricing__list">
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Вклад от 10 000 - 1 000 000 ₽</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Срок 24 часа</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        24/7 technical support</li>
                      <li class="pricing__list-item"><span><img src="assets/images/icon/check.svg" alt="check"
                            class="dark"></span>
                        Personal training</li>
                    </ul>

                  </div>
<script type="text/javascript">
        function calca() {
            //получаем ссылку на элемент input (Кол-во вариантов)
            var counta = document.getElementById("counta");
            //получаем ссылку на элемент span, в него будем писать стоимость дизайна
            var resulta = document.getElementById("resulta");

            pricea = parseInt(counta.value) * 1.5;

            resulta.innerHTML = pricea;
        }

</script>
    <body>
        Сумма вклада      <input type="number"  min="0" class="counts" data-recovery="1" data-min="10000" data-max="1000000"
        data-days="3" data-perc="50"
        id="counts" value="300" onchange="calcs()" />

        <div class="input-notice">"минимальная максимальная сумма согласно диапазону"</div>
        <div>Вы получите: <span class="result" id="results">0</span></div>
    </body>
                  <!-- pricing bottom part -->
                  <div class="pricing__item-bottom">
                    <a href="signup.html" class="trk-btn trk-btn--outline">Инвестировать</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

	  <br>
 <style>
                      input::-webkit-outer-spin-button,
                      input::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                      }
                      input[type='number'] {
                        -moz-appearance: textfield;
                      }
                      .input-notice {
                        height: 0;
                        overflow: hidden;
                        position: relative;
                        top: -11px;
                        opacity: 0.2;
                        color: red;
                        font-size: 15px;
                        transition: all 1s;
                      }

                      .input-notice.active {
                        height: auto;
                        opacity: 1;
                        top: 0;
                      }
                    </style>

<script>
                      document.addEventListener('DOMContentLoaded', function () {

                        function calc(amount, perc, days, recovery) {
                          amount = Number(amount);
                          let perc2 = Number(perc) / 100;
                          let perc3 = perc2 * Number(days);
                          let res = (amount * perc3) + (amount * recovery);
                          return res;
                        };

                        function roundUp(num, decimal) {
                          const factor = 10 ** decimal;
                          return Math.ceil(num * factor) / factor;
                        }

                        const moduleSection = document.querySelectorAll('.lqd-tabs-pane .tarif-item');

                        moduleSection.forEach((item, index) => {

                          const input = item.querySelector('.counts');
                          const notice = item.querySelector('.input-notice');
                          const result = item.querySelector('.result');

                          let min = Number(input.getAttribute('data-min'));
                          let max = Number(input.getAttribute('data-max'));
                          let recovery = Number(input.getAttribute('data-recovery'));

                          let percent = input.getAttribute('data-perc');
                          let days = input.getAttribute('data-days');

                          input.addEventListener('input', function () {

                            let amount = Number(input.value);
                            let res = calc(amount, percent, days, recovery);
                            res = roundUp(res, 3);

                            if(amount < min || amount > max){
                              notice.classList.add('active');
                              result.innerText = 0;
                              return;
                            }
                            notice.classList.remove('active');
                            result.innerText = res;
                          });

                          const event = new Event('input');
                          input.dispatchEvent(event);

                        })
                      })
                    </script>
	  <div class="pricing__item-inner active">
                <div class="pricing__item-content">

                  <!-- pricing top part -->
                  <div class="pricing__item-top">
                    <h6 class="mb-15">Калькулятор прибыли</h6>
                  </div>

                  <!-- pricing middle part -->
                  <div class="pricing__item-middle">
                    <ul class="pricing__list">
                      <li class="pricing__list-item"><span><img src="file:///C:/Downloaded%20Web%20Sites/thetork.com/demos/html/bitrader/assets/images/icon/check.svg" alt="check" class="dark"></span>
                        Weekly online meeting</li>

                    </ul>

                  </div>

                  <!-- pricing bottom part -->
                  <div class="pricing__item-bottom">
                    <a href="signup.html" class="trk-btn trk-btn--outline active">Choose Plan</a>
                  </div>
                </div>
              </div>
    </div>




    <div class="pricing__shape">
      <span class="pricing__shape-item pricing__shape-item--5"> <img src="assets/images/icon/shape/3.png"
          alt="shape-icon"></span>
      <span class="pricing__shape-item pricing__shape-item--6"> <img src="assets/images/icon/shape/1.png"
          alt="shape-icon">
      </span>
    </div>
  </section>
  <!-- ===============>> Pricing section start here <<================= -->

  <!-- ===============>> Pricing section start here <<================= -->
  <section class="pricing padding-top padding-bottom" id="partner">
     <div class="section-header section-header--max50">
      <h2 class="mb-15 mt-minus-5">Приглашайте <span>зарабатывайте</span></h2>
      <p>Рекомендуйте друзьям, родственникам, коллегам и знакомым нащу площадку и получайте % от их вкладов.</p>
    </div>
    <div class="container">
      <div class="team__wrapper">
        <div class="row g-4 align-items-center">
          <div class="col-sm-6 col-lg-3">
            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="800">
              <div class="team__item-inner team__item-inner--shape">
                <div class="team__item-thumb team__item-thumb--style1">
                  <img src="assets/images/team/1.png" alt="Team Image" class="dark">
                </div>
                <div class="team__item-content team__item-content--style1">
                  <div class="team__item-author team__item-author--style1">
                    <div class="team__item-authorinfo">
                      <h6 class="mb-1"><a href="team-details.html" class="stretched-link">10%</a> </h6>
                      <p class="mb-0">Лично приглашенные</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="900">
              <div class="team__item-inner team__item-inner--shape">
                <div class="team__item-thumb team__item-thumb--style1">
                  <img src="assets/images/team/2.png" alt="Team Image" class="dark">
                </div>
                <div class="team__item-content team__item-content--style1">
                  <div class="team__item-author team__item-author--style1">
                    <div class="team__item-authorinfo">
                      <h6 class="mb-1"><a href="team-details.html" class="stretched-link">7%</a> </h6>
                      <p class="mb-0">2 уровень</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="1000">
              <div class="team__item-inner team__item-inner--shape">
                <div class="team__item-thumb team__item-thumb--style1">
                  <img src="assets/images/team/3.png" alt="Team Image" class="dark">
                </div>
                <div class="team__item-content team__item-content--style1">
                  <div class="team__item-author team__item-author--style1">
                    <div class="team__item-authorinfo">
                      <h6 class="mb-1"><a href="team-details.html" class="stretched-link">6%</a> </h6>
                      <p class="mb-0">3 уровень</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="1100">
              <div class="team__item-inner team__item-inner--shape">
                <div class="team__item-thumb team__item-thumb--style1">
                  <img src="assets/images/team/4.png" alt="Team Image" class="dark">
                </div>
                <div class="team__item-content team__item-content--style1">
                  <div class="team__item-author team__item-author--style1">
                    <div class="team__item-authorinfo">
                      <h6 class="mb-1"><a href="team-details.html" class="stretched-link">4%</a> </h6>
                      <p class="mb-0">4 уровень</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="800">
              <div class="team__item-inner team__item-inner--shape">
                <div class="team__item-thumb team__item-thumb--style1">
                  <img src="assets/images/team/5.png" alt="Team Image" class="dark">
                </div>
                <div class="team__item-content team__item-content--style1">
                  <div class="team__item-author team__item-author--style1">
                    <div class="team__item-authorinfo">
                      <h6 class="mb-1"><a href="team-details.html" class="stretched-link">2%</a> </h6>
                      <p class="mb-0">5 уровень</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="900">
              <div class="team__item-inner team__item-inner--shape">
                <div class="team__item-thumb team__item-thumb--style1">
                  <img src="assets/images/team/6.png" alt="Team Image" class="dark">
                </div>
                <div class="team__item-content team__item-content--style1">
                  <div class="team__item-author team__item-author--style1">
                    <div class="team__item-authorinfo">
                      <h6 class="mb-1"><a href="team-details.html" class="stretched-link">1%</a> </h6>
                      <p class="mb-0">6 уровень</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="1000">
              <div class="team__item-inner team__item-inner--shape">
                <div class="team__item-thumb team__item-thumb--style1">
                  <img src="assets/images/team/7.png" alt="Team Image" class="dark">
                </div>
                <div class="team__item-content team__item-content--style1">
                  <div class="team__item-author team__item-author--style1">
                    <div class="team__item-authorinfo">
                      <h6 class="mb-1"><a href="team-details.html" class="stretched-link">1%</a> </h6>
                      <p class="mb-0">7 уровень</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="1100">
              <div class="team__item-inner team__item-inner--shape">
                <div class="team__item-thumb team__item-thumb--style1">
                  <img src="assets/images/team/8.png" alt="Team Image" class="dark">
                </div>
                <div class="team__item-content team__item-content--style1">
                  <div class="team__item-author team__item-author--style1">
                    <div class="team__item-authorinfo">
                      <h6 class="mb-1"><a href="team-details.html" class="stretched-link">1%</a> </h6>
                      <p class="mb-0">8 уровень</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="text-center">
		  <h2 class="mb-15 mt-minus-5">Имеете большую аудиторию?</h2><br><h3 class="mb-15 mt-minus-5">Получите персональные условия</h3>

            <a href="" onclick="jivo_api.open();" class="trk-btn trk-btn--border trk-btn--primary mt-25">Написать нам</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===============>> Pricing section start here <<================= -->


  <!-- ===============>> Testimonial section start here <<================= -->
  <section class="testimonial padding-top padding-bottom-style2 bg-color">
    <div class="container">
      <div class="section-header d-md-flex align-items-center justify-content-between">
        <div class="section-header__content">
          <h2 class="mb-15">Реальный отзывы<span> клиентов </span></h2>
          <p class="mb-0">Мы работаем честно и прозрачно и рады вышим отзывам о нашей работе.
          </p>
        </div>

      </div>
      <div class="testimonial__wrapper" data-aos="fade-up" data-aos-duration="1000">
       <div class="swiper-slide swiper-slide-duplicate swiper-slide-active" data-swiper-slide-index="0" role="group" aria-label="1 / 3" style="width: 100%; margin-right: 25px;">
              <div class="testimonial__item testimonial__item--style1">
                <div class="testimonial__item-inner">
                  <div class="testimonial__item-content">
                    <p class="mb-0">
                      The above testimonial is about Martha Chumo, who taught herself to code in one summer. This
                      testimonial example works because it allows prospective customers to see themselves in
                      Codeacademy’s current customer base.
                    </p>
                    <div class="testimonial__footer">
                      <div class="testimonial__author">
                        <div class="testimonial__author-thumb">
                          <img src="assets/images/testimonial/1.png" alt="author">
                        </div>
                        <div class="testimonial__author-designation">
                          <h6>LOTOS GROUP</h6>
                        </div>
                      </div>
                      <div class="testimonial__quote">
                        <span><svg class="svg-inline--fa fa-quote-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 296c0 66.3-53.7 120-120 120h-8c-17.7 0-32-14.3-32-32s14.3-32 32-32h8c30.9 0 56-25.1 56-56v-8H320c-35.3 0-64-28.7-64-64V160c0-35.3 28.7-64 64-64h64c35.3 0 64 28.7 64 64v32 32 72zm-256 0c0 66.3-53.7 120-120 120H64c-17.7 0-32-14.3-32-32s14.3-32 32-32h8c30.9 0 56-25.1 56-56v-8H64c-35.3 0-64-28.7-64-64V160c0-35.3 28.7-64 64-64h64c35.3 0 64 28.7 64 64v32 32 72z"></path></svg><!-- <i class="fa-solid fa-quote-right"></i> Font Awesome fontawesome.com --></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
  </section>
  <!-- ===============>> Testimonial section start here <<================= -->




  <!-- ===============>> FAQ section start here <<================= -->
  <section class="faq padding-top padding-bottom of-hidden" id="faq">
    <div class="section-header section-header--max65">
      <h2 class="mb-15 mt-minus-5"><span>Часто задаваемые</span> Вопросы</h2>
      <p>Если Вы не нашли ответ на нужный вопрос, то напишите онлайн консультанту, он поможет.</p>
    </div>
    <div class="container">
      <div class="faq__wrapper">
        <div class="row g-5 align-items-center justify-content-between">
          <div class="col-lg-6">
            <div class="accordion accordion--style1" id="faqAccordion1" data-aos="fade-right" data-aos-duration="1000">
              <div class="row">
                <div class="col-12">
                  <div class="accordion__item ">
                    <div class="accordion__header" id="faq1">
                      <button class="accordion__button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqBody1" aria-expanded="false" aria-controls="faqBody1">
                        <span class="accordion__button-content">Как зарабатывать?</span>
                        <span class="accordion__button-plusicon"></span>
                      </button>
                    </div>
                    <div id="faqBody1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                      data-bs-parent="#faqAccordion1">
                      <div class="accordion__body">
                        <p class="mb-15">
                          Для того, чтобы начать работу с Lotos Capital LTD, Вам следует пройти простую процедуру регистрации на нашем сайте. Далее необходимо внести свой первый депозит, выбрав соответствующий раздел в личном кабинете "Пополнить" после чего вся инвестиционная работа будет проводиться нашей компанией, а Вы, в свою очередь, получите свой доход через 24 часа.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="accordion__item ">
                    <div class="accordion__header" id="faq2">
                      <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqBody2" aria-expanded="true" aria-controls="faqBody2">
                        <span class="accordion__button-content">Какая минимальная и максимальная сумма депозита?</span>
                        <span class="accordion__button-plusicon"></span>
                      </button>
                    </div>
                    <div id="faqBody2" class="accordion-collapse collapse" aria-labelledby="faq2"
                      data-bs-parent="#faqAccordion1">
                      <div class="accordion__body">
                        <p class="mb-15">
                          Минимальный размер депозита – От 300 рублей.
Максимальный размер депозита – 1 000 000 рублей.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="accordion__item ">
                    <div class="accordion__header" id="faq3">
                      <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqBody3" aria-expanded="false" aria-controls="faqBody3">
                        <span class="accordion__button-content">Я оформил вывод средств через сколько средства поступят на мой счет?</span>
                        <span class="accordion__button-plusicon"></span>
                      </button>
                    </div>
                    <div id="faqBody3" class="accordion-collapse collapse" aria-labelledby="faq3"
                      data-bs-parent="#faqAccordion1">
                      <div class="accordion__body">
                        <p class="mb-15"> Вывод средств происходит от 15 минут  до 48-ми часов.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="accordion__item ">
                    <div class="accordion__header" id="faq4">
                      <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqBody4" aria-expanded="false" aria-controls="faqBody4">
                        <span class="accordion__button-content">Как пригласить друга по своей ссылке ?</span>
                        <span class="accordion__button-plusicon"></span>
                      </button>
                    </div>
                    <div id="faqBody4" class="accordion-collapse collapse" aria-labelledby="faq4"
                      data-bs-parent="#faqAccordion1">
                      <div class="accordion__body">
                        <p class="mb-15">  Ваша реферальная ссылка находится в личном кабинете в разделе "Партнерство" скопируйте свою ссылку и отправьте другу. Важно помнить при регистрации должен отображаться ваш логин "Пригласителя"</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="accordion__item ">
                    <div class="accordion__header" id="faq5">
                      <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqBody5" aria-expanded="false" aria-controls="faqBody5">
                        <span class="accordion__button-content">Какая электронная валюта используется для работы?</span>
                        <span class="accordion__button-plusicon"></span>
                      </button>
                    </div>
                    <div id="faqBody5" class="accordion-collapse collapse" aria-labelledby="faq5"
                      data-bs-parent="#faqAccordion1">
                      <div class="accordion__body">
                        <p class="mb-15"> Карты VISA/MasterCard/Maestro/МИР, Яндекс.Деньги, BitCoin, Usdt, Tron, ETH.</p>
                      </div>
                    </div>
                  </div>
                </div> <!--
                <div class="col-12">
                  <div class="accordion__item border-0">
                    <div class="accordion__header" id="faq6">
                      <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqBody6" aria-expanded="false" aria-controls="faqBody6">
                        <span class="accordion__button-content"> How to create a trading account?</span>
                        <span class="accordion__button-plusicon"></span>
                      </button>
                    </div>
                    <div id="faqBody6" class="accordion-collapse collapse" aria-labelledby="faq6"
                      data-bs-parent="#faqAccordion1">
                      <div class="accordion__body">
                        <p class="mb-15"> Online trading’s primary advantages are that it allows you to manage your trades at your convenience.</p>
                      </div>
                    </div>
                  </div>
                </div> --!>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="faq__thumb faq__thumb--style2 text-center" data-aos="fade-left" data-aos-duration="1000">
              <img class="dark" src="assets/images/others/3.png" alt="faq-thumb">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="faq__shape">
      <span class="faq__shape-item faq__shape-item--2"><img src="assets/images/icon/shape/2.png"
          alt="shpae-icon"></span>
      <span class="faq__shape-item faq__shape-item--3"><img src="assets/images/icon/shape/4.png"
          alt="shpae-icon"></span>
    </div>
  </section>
  <!-- ===============>> FAQ section start here <<================= -->



  <!-- ===============>> cta section start here <<================= -->
<section class="cta cta--style2">
    <div class="container">
      <div class="cta__wrapper">
        <div class="cta__newsletter justify-content-center">
          <div class="cta__newsletter-inner cta__newsletter-inner--style2 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
            <div class="cta__thumb">
              <img src="assets/images/cta/3.png" alt="cta-thumb">
            </div>
            <div class="cta__subscribe">
              <h2 class="mb-0"> <span>Высокий</span> доход</h2>
              <p>Регистрируйтесь, открывайте депозит и начинайте зарабатывать прямо сейчас!</p>
              <form class="cta-form cta-form--style2 form-subscribe" action="#">
                <div class="cta-form__inner d-sm-flex align-items-center">
                @guest
               <a href="/user/login" class="trk-btn  trk-btn--large trk-btn--secondary2" type="submit">Вход</a> &nbsp; &nbsp;
               <a href="/user/register" class="trk-btn  trk-btn--large trk-btn--secondary2" type="submit">Регистрация</a>
               @else
               <a href="{{ route('user.home') }}" class="trk-btn  trk-btn--large trk-btn--secondary2" type="submit">Кабинет</a>
               @endif
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===============>> cta section start here <<================= -->





  <!-- ===============>> footer start here <<================= -->
  <footer class="footer brand-1">
    <div class="container">
      <div class="footer__wrapper">
        <div class="footer__top footer__top--style2">
          <div class="row gy-5 gx-4">
            <div class="col-lg-6 col-md-5">
              <div class="footer__about">
                <a href="/" class="footer__about-logo"><img src="assets/images/logo/logo-dark.png" alt="Logo"></a>
                <p class="footer__about-moto ">Компания Lotos Capital занимается инвестиционной финансовой деятельностью на рынке криптовалют и P2P сфере.</p>
                <div>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-6">
              <div class="footer__links">
                <div class="footer__links-tittle">
                  <h6>Информация</h6>
                </div>
                <div class="footer__links-content">
                  <ul class="footer__linklist">
                    <li class="footer__linklist-item"> <a href="/">Главная</a>
                    </li>
                    <li class="footer__linklist-item"> <a href="#about">О компании</a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
              <div class="footer__links">
                <div class="footer__links-tittle">
                  <h6>Кабинет</h6>
                </div>
                <div class="footer__links-content">
                  <ul class="footer__linklist">
                    <li class="footer__linklist-item"> <a href="/user/login">Вход</a>
                    </li>
                    <li class="footer__linklist-item"> <a href="/user/register">Регистрация</a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-4">
              <div class="footer__links">
                <div class="footer__links-tittle">
                  <h6>Помощь</h6>
                </div>
                <div class="footer__links-content">
                  <ul class="footer__linklist">
                    <li class="footer__linklist-item"> <a href="#faq">FAQ</a>
                    </li>
                    <li class="footer__linklist-item"> <a href="" onclick="jivo_api.open();">Поддержка</a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="footer__bottom">
          <div class="footer__end justify-content-center">
            <div class="footer__end-copyright">
              <p class=" mb-0">© 2023 All Rights Reserved By <a href="/" target="_blank">Lotos Capital</a> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__shape">
      <span class="footer__shape-item footer__shape-item--3"><img src="assets/images/footer/1.png" alt="shape icon"></span>
    </div>
  </footer>
  <!-- ===============>> footer end here <<================= -->






  <!-- vendor plugins -->

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/all.min.js"></script>
  <script src="assets/js/swiper-bundle.min.js"></script>
  <script src="assets/js/aos.js"></script>
  <script src="assets/js/fslightbox.js"></script>

  <script src="assets/js/purecounter_vanilla.js"></script>

  <script src="assets/js/custom.js"></script>


</body>

</html>
@endsection
