<!doctype html>
<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Расписание</title>
        <link href="/css/style.css" rel="stylesheet">
        <script src="/js/jquery-3.3.1.min.js"></script> 
        <script src="/js/script_main.js"></script>
        <!--[if lte IE 8]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>         
        <div class="wraper">	
            <div class="row">
                <div class="item">
                    <p>Курс</p>
                    <select name="course" class="course_select">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="item">
                    <p>Группа</p>
                    <select name="group" class="group_select">
                        <option value="" id="group"></option>
                    </select>
                </div>
                <div class="item">
                    <p>День недели</p>
                    <select name="day" class="day_select">
                        <option selected value="Mon">Понедельник</option>
                        <option value="Tue">Вторник</option>
                        <option value="Wed">Среда</option>
                        <option value="Thu">Четверг</option>
                        <option value="Fri">Пятница</option>
                        <option value="Sat">Суббота</option>
                    </select>
                </div>
                <div class="item">
                    <p>Четная/Нечетная неделя</p>
                    <select name="odd" class="odd_select">
                        <option selected value="2">Четная</option>
                        <option value="1">Нечетная</option>
                    </select>
                </div>
            </div>

            <button type="button" class="look">Посмотреть</button>
            <br>

            <div class="schedule">
            </div>

        </div>     
        <footer>

        </footer>       
    </body>
</html>
