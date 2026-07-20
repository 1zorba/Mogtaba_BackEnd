<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>

 
    @vite(['resources/css/app.css','resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-slate-950 text-white overflow-x-hidden">

    @yield('content')

</body>

<script>

let lastScroll = 0;

const navbar = document.querySelector(".premium-nav");


window.addEventListener("scroll",()=>{


    let currentScroll = window.pageYOffset;



    // عند النزول تختفي

    if(currentScroll > lastScroll && currentScroll > 100){

        navbar.style.transform =
        "translate(-50%, -150%)";

        navbar.style.opacity="0";

    }


    // عند الصعود تظهر

    else{


        navbar.style.transform =
        "translate(-50%,0)";

        navbar.style.opacity="1";

    }



    lastScroll=currentScroll;


});


</script>
</html>