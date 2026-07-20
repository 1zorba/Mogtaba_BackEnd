<nav class="premium-nav">


<div class="nav-container">


<!-- Logo -->

<a href="/" class="logo">


     <h1>
        
        {{Str::after($userData->name,' ') }}
    </h1>


 
<span>{{Str::before($userData->name,' ')}}
</span>

</a>




<!-- Links -->

<div class="nav-links">


<a href="/" class="nav-item">

 
الرئيسية

</a>



<a href="{{route('projects.show')}}" class="nav-item">

     <i class="fa-solid fa-envelope-open-text"></i>

المشاريع

</a>

<a href="{{route('services.show')}}" class="nav-item">

     <i class="fa-solid fa-envelope-open-text"></i>

الخدمات

</a>




<a href="{{route('poem.show')}}" class="nav-item">

 
القصائد

</a>


 


</div>



</div>


</nav>

<style>
    /* ===============================
   FUTURISTIC NAVBAR
================================ */


.premium-nav{


position:fixed;

top:0px;

left:50%;

transform:translateX(-50%);


width:90%;

max-width:1200px;


z-index:999;


animation:

navEnter 1s ease;


}




@keyframes navEnter{


from{

opacity:0;

transform:
translate(-50%,-80px);

}


to{


opacity:1;


transform:
translate(-50%,0);


}


}







.nav-container{


display:flex;


align-items:center;


justify-content:space-between;


padding:5px 30px;
 /* padding: 5px 49px */


border-radius:30px;



background:

rgba(15,23,42,.65);



border:

1px solid rgba(255,255,255,.12);



backdrop-filter:

blur(20px);



box-shadow:

0 20px 50px

rgba(0,0,0,.4);


}





/* LOGO */


.logo{


font-size:30px;

font-weight:900;


color:white;


text-decoration:none;


letter-spacing:1px;



}



.logo span{


color:#6366f1;


text-shadow:

0 0 20px #6366f1;


}






/* LINKS */


.nav-links{


display:flex;


gap:15px;


}





.nav-item{


position:relative;


display:flex;


align-items:center;


gap:8px;


padding:12px 20px;


border-radius:20px;


color:#cbd5e1;


text-decoration:none;


font-weight:600;


overflow:hidden;


transition:.5s;



}





.nav-item span{


font-size:18px;


}





.nav-item::before{


content:"";


position:absolute;


inset:0;


background:

linear-gradient(
135deg,
rgba(99,102,241,.3),
rgba(6,182,212,.2)
);



opacity:0;


transition:.5s;


}




.nav-item:hover::before{


opacity:1;


}




.nav-item:hover{


color:white;


transform:

translateY(-5px);


box-shadow:


0 15px 30px

rgba(99,102,241,.3);


}





/* Animated underline */


.nav-item::after{


content:"";


position:absolute;


bottom:5px;


left:50%;


width:0;


height:3px;


border-radius:20px;


background:

linear-gradient(
90deg,
#6366f1,
#06b6d4
);



transition:.5s;



transform:

translateX(-50%);


}





.nav-item:hover::after{


width:60%;


}





/* Floating animation */


.premium-nav{


animation:

navFloat 6s infinite ease-in-out;


}



@keyframes navFloat{


0%,100%{


margin-top:0;


}


50%{


margin-top:8px;


}


}





/* MOBILE */


@media(max-width:800px){


.nav-container{


flex-direction:column;


gap:20px;


}



.nav-links{


flex-wrap:wrap;


justify-content:center;


}



.nav-item{


padding:10px 15px;


}



}
</style>