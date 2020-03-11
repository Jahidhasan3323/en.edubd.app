<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Haml Calendar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="{{ asset('/public/fontend/style.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>
<body>
<!-- partial:index.partial.html -->
<!-- / ------------- Try a custom date: -->
<!-- /- year = 2014 -->
<!-- /- month = 1 -->
<!-- /- day = 31 -->
<div class='container'>
  
  <div class='calendar'>
    <div class='month'>
      January
      2020
    </div>
    <ul class='weekdays'>
      <li class='weekday'>
        S
      </li>
      <li class='weekday'>
        M
      </li>
      <li class='weekday'>
        T
      </li>
      <li class='weekday'>
        W
      </li>
      <li class='weekday'>
        T
      </li>
      <li class='weekday'>
        F
      </li>
      <li class='weekday'>
        S
      </li>
    </ul>
    <ul class='week'>
      <li class='day'>
      </li>
      <li class='day'>
      </li>
      <li class='day'>
      </li>
      <li class='day'>
        <span class='mute'>
          1
        </span>
      </li>
      <li class='day now'>
        2
      </li>
      <li class='day'>
        3
      </li>
      <li class='day'>
        4
      </li>
      <li class='day'>
        5
      </li>
      <li class='day'>
        6
      </li>
      <li class='day'>
        7
      </li>
      <li class='day'>
        8
      </li>
      <li class='day'>
        9
      </li>
      <li class='day'>
        10
      </li>
      <li class='day'>
        11
      </li>
      <li class='day'>
        12
      </li>
      <li class='day'>
        13
      </li>
      <li class='day'>
        14
      </li>
      <li class='day'>
        15
      </li>
      <li class='day'>
        16
      </li>
      <li class='day'>
        17
      </li>
      <li class='day'>
        18
      </li>
      <li class='day'>
        19
      </li>
      <li class='day'>
        20
      </li>
      <li class='day'>
        21
      </li>
      <li class='day'>
        22
      </li>
      <li class='day'>
        23
      </li>
      <li class='day'>
        24
      </li>
      <li class='day'>
        25
      </li>
      <li class='day'>
        26
      </li>
      <li class='day'>
        27
      </li>
      <li class='day'>
        28
      </li>
      <li class='day'>
        29
      </li>
      <li class='day'>
        30
      </li>
      <li class='day'>
        31
      </li>
    </ul>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 <script  src="{{ asset('/public/fontend/script.js')}}"></script>

</body>
</html>