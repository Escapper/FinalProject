
<html>

    <body>   

    <div id="poll_div"></div>

    {!! $lava->render('DonutChart', 'Doctors', 'poll_div') !!}

    </body>





</html>


<style>

#poll_div {
    height : 500px;
}

</style>