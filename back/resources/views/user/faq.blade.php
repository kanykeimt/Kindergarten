@extends('layouts.app')
@section('content')
    <style>
        .accordion {
            background-color: #4da3ff;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 20px;
            transition: 0.4s;
            border-radius: 10px;

        }

        .active, .accordion:hover {
            background-color: #007bff;
        }

        .accordion:after {
            content: '\002B';
            color: black;
            font-weight: bold;
            float: right;
            margin-left: 20px;
        }

        .active:after {
            content: "\2212";
        }

        .panel {
            padding: 0 18px;
            background-color: #e6f2ff;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            border-radius: 10px;
        }
    </style>
    <div class="container d-flex justify-content-center">
        @if(app()->getLocale() == "ru")
            <div class="col-sm-10" style="margin-top: 10px;">
                <button class="accordion" > С какого возраста детский сад принимает детей? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Мы принимаем детей в возрасте от 2-х лет, иногда в более раннем возрасте, если ребенок легко переносит разлуку с мамой и адаптация происходит безболезненно.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #5D3FB6">  Режим работы детского сада?  </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Для удобства родителей, детский сад работает с 8.00 утра до 18.30 вечера.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #8EB542"> Делаете ли вы перерасчет в случае отсутствия ребенка? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Мы делаем перерасчет в случае отсутствия ребенка более трех дней.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #FAD01A"> Какие вещи ребенка надо будет принести в детский сад? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Мы рекомендуем принести:
                            <br>- Комплект сменной одежды (футболочки, шортики, штанишки - для мальчиков, футболочки, платьица, юбочки - для девочек)
                            <br>- Комплект сменного белья (трусики, носочки)
                            <br>- Сменная обувь (удобнее на липучках)
                            <br>- Пижамка
                            <br>- Форма для занятий физкультурой и ритмикой (белая футболка, чешки, девочки – лосины, мальчики – шортики)
                            <br>- Расческа
                            <br>- Для самых маленьких - подгузники (на 1 день хватает 3-4 штуки)</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #F57C21"> Есть ли у вас вступительный взнос? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>У нас нет вступительного взноса.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #EF4528"> Сколько групп в детском саду? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>В детском саду минимум 3 группы: младшая, средняя и старшая. На каждую группу- один воспитатель и нянечка.</p>
                    </div>
                </div>
                <br>



                <button class="accordion" > Какой режим дня у детей? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Это примерный режим:
                            <br><b>8:00 – 9:00</b> — Прием детей, свободные игры.
                            <br><b>9:00 – 9:30 </b>— Завтрак.
                            <br><b>9:30 – 11:00</b> — Образовательная деятельность.
                            <br><b>11:00 – 11:30</b> — Прогулка.
                            <br><b>11:30 – 12:30</b> — Подготовка к обеду, обед.
                            <br><b>12:30 – 15:00</b> — Тихий час.
                            <br><b>15:00 – 15:30</b> — Полдник.
                            <br><b>15:30 – 16:30</b> — Вторая образовательная деятельность.
                            <br><b>16:30 – 17:00</b> — Прогулка.
                            <br><b>17:00 – 18:00</b> — Игры и подготовка к уходу домой.
                        </p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #5D3FB6">  Какие мероприятия и занятия проводятся для детей?  </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>В детском саду проводятся различные занятия по развитию речи, математике, рисованию, музыке и физкультуре. Также проводятся тематические праздники, утренники и спортивные мероприятия.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #8EB542"> Какое питание предоставляется детям? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Питание в детском саду сбалансированное и разнообразное. Дети получают завтрак, обед, полдник. В меню включены свежие овощи, фрукты, мясо, рыба, молочные продукты.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #FAD01A">  Как сообщить о болезни или отсутствии ребенка?? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Если ребенок заболел или по другой причине не сможет прийти в детский сад, пожалуйста, сообщите об этом воспитателю по телефону заранее.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #F57C21"> Как происходит адаптация новых детей? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Мы помогаем детям адаптироваться к новому окружению постепенно. Сначала ребенок может приходить на несколько часов, затем время пребывания постепенно увеличивается.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #EF4528"> Как поддерживается чистота и гигиена? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Помещения регулярно убираются и дезинфицируются. Дети учатся мыть руки перед едой, после прогулок и посещения туалета. У нас есть все необходимые гигиенические средства.</p>
                    </div>
                </div>
                <br>
            </div>
        @elseif(app()->getLocale() == "kg")
            <div class="col-sm-10" style="margin-top: 10px;">
                <button class="accordion" > Бала бакча канча жаштан балдарды кабыл алат? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Биз балдарды 2 жаштан баштап кабыл алабыз, кээде эрте куракта, эгерде бала апасынан ажырап калууга оңой чыдаса жана адаптация оорутпай жүрсө.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #5D3FB6">  Бала бакчанын иштөө убактысы? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Ата-энелердин ыңгайлуулугу үчүн бала бакча эртең мененки саат 8.00дөн 18.30га чейин иштейт.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #8EB542"> Бала жок болгон учурда кайра эсептейсизби?  </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Бала үч күндөн ашык келбей калса, кайра эсептейбиз.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #FAD01A"> Балам бала бакчага эмнелерди алып барышы керек? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Мы рекомендуем принести:
                            <br>- Өзгөртүлүүчү кийимдердин топтому (футболкалар, шортылар, шым - балдар үчүн, футболкалар, көйнөктөр, юбкалар - кыздар үчүн)
                            <br>- Өзгөртүлүүчү ич кийимдердин топтому (трусика, байпак)
                            <br>- Алмаштырылган бут кийим (ыңгайлуураак)
                            <br>- Пижамалар
                            <br>- Дене тарбия жана ритм сабактары үчүн бирдиктүү форма (ак футболка, чех бут кийими, кыздар - леггинстер, балдар - шорты)
                            <br>- Тарак
                            <br>- Кичинекейлерге - памперс (1 күнгө 3-4 даана жетиштүү)
                        </p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #F57C21"> Сизде кирүү акысы барбы? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p> Бизде кирүү акысы жок.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #EF4528"> Бала бакчада канча тайпа бар? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Бала бакчада кеминде 3 тайпа бар: кенже, орто жана улуу. Ар бир тайпага бирден мугалим жана няня бар.</p>
                    </div>
                </div>
                <br>



                <button class="accordion" > Балдардын күн тартиби кандай? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Бул болжолдуу режим:
                            <br><b>8:00 – 9:00</b> — Балдарды кабыл алуу, эркин оюндар.
                            <br><b>9:00 – 9:30 </b>— Эртең мененки тамак.
                            <br><b>9:30 – 11:00</b> — Билим берүү иш-чаралары.
                            <br><b>11:00 – 11:30</b> — Сейилдөө.
                            <br><b>11:30 – 12:30</b> — Түшкү тамакка даярдануу, түшкү тамак.
                            <br><b>12:30 – 15:00</b> — Тынч саат.
                            <br><b>15:00 – 15:30</b> — Түшкү чай.
                            <br><b>15:30 – 16:30</b> — Экинчи билим берүү иш-чаралары.
                            <br><b>16:30 – 17:00</b> — Сейилдөө.
                            <br><b>17:00 – 18:00</b> — Оюндар жана үйгө кетүүгө даярдануу.
                        </p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #5D3FB6">  Балдар үчүн кандай иш-чаралар жана иш-чаралар сунушталат? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Бала бакчада сүйлөө, математика, сүрөт, музыка жана дене тарбия боюнча ар кандай класстар уюштурулат. Ошондой эле тематикалык майрамдар, эртең мененки жана спорттук иш-чаралар өткөрүлөт.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #8EB542"> Балдарга кандай тамактар берилет? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Бала бакчадагы тамактар салмактуу жана ар түрдүү. Балдар эртең мененки тамакты, түшкү тамакты жана түштөн кийинки тамакты алышат. Менюда жаңы жашылчалар, жемиштер, эт, балык жана сүт азыктары бар.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #FAD01A">  Баланын оорусу же жоктугу жөнүндө кантип билдирүү керек? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Эгерде сиздин балаңыз ооруп калса же башка себептерден улам бала бакчага келе албаса, мугалимге алдын ала телефон аркылуу кабарлаңыз.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #F57C21"> Жаңы балдар кантип адаптацияланат? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Биз балдарга жаңы чөйрөгө акырындык менен көнүүгө жардам беребиз. Адегенде бала бир нече саатка келиши мүмкүн, андан кийин калуу акырындык менен көбөйөт.</p>
                    </div>
                </div>
                <br>
                <button class="accordion" style="background-color: #EF4528"> Тазалык жана гигиена кантип сакталат? </button>
                <div class="panel">
                    <div class="position-relative table-responsive"><br>
                        <p>Имарат дайыма тазаланып, дезинфекцияланып турат. Балдар тамактанардын алдында, сейилдөөдөн жана дааратканадан кийин колдорун жууганды үйрөнүшөт. Бизде бардык керектүү гигиеналык каражаттар бар.</p>
                    </div>
                </div>
                <br>
            </div>
        @endif

    </div>

    <script>
        let acc = document.getElementsByClassName("accordion");
        let i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                let panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>
@endsection
