<footer class="premium-footer">


<div class="footer-glow"></div>



<div class="footer-container">



    <!-- Logo -->

    <div class="footer-brand">

        <h2>
    <span>{{Str::after($userData->name,' ') }}</span>

    {{Str::after($userData->name,' ') }} 

      
      

        </h2>
      

        <p>

         {{$userData->profile->bio}}

        </p>


    </div>





    <!-- Links -->

    <div class="footer-links">


        <a href="/">

            Home

        </a>


<a href="{{route('projects.show')}}"  >

             Projects

        </a>


        <a href="{{route('poem.show')}}">


            Poems
           

        </a>


        


    </div>





    <!-- Social -->

    <div class="footer-social">

 


            <!-- FACEBOOK -->
                    @if(!empty($userData->profile->social_links))
                        <a href="{{ $userData->profile->social_links }}" target="_blank" class="social-btn facebook" title="Facebook">
                            <svg viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        Facebook
                    @endif

   <!-- WHATSAPP -->
                    @if(!empty($userData->profile->social_links2))
                        <a href="{{ $userData->profile->social_links2 }}" target="_blank" class="social-btn whatsapp" title="WhatsApp">
                            <svg viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                        </a>
                        WhatsApp
                    @endif


    </div>




</div>




<div class="footer-bottom">


 مجتبى.
جميع الحقوق محفوظة.
© {{date('Y')}}

</div>
<style >
    .text-gray{
        color: #413939;

 text-align: center
    }
</style>
<div class="text-gray">
    <a href="{{ route('login') }}"
>

All Rights Reserved @

</a>
</div>


</footer>


<style>


/* ===========================
   FUTURISTIC FOOTER
=========================== */


.premium-footer{


position:relative;


background:


radial-gradient(
circle at top,
rgba(99,102,241,.25),
transparent 40%
),


#020617;


padding:70px 20px 25px;


overflow:hidden;


border-top:

1px solid rgba(255,255,255,.1);



}



.footer-glow{


position:absolute;


width:300px;

height:300px;


background:#6366f1;


filter:blur(150px);


opacity:.25;


top:-100px;


left:50%;


transform:translateX(-50%);



animation:

footerGlow 5s infinite;



}



@keyframes footerGlow{


0%,100%{

transform:
translateX(-50%)
scale(1);


}


50%{

transform:
translateX(-50%)
scale(1.3);


}



}







.footer-container{


max-width:1200px;


margin:auto;


display:grid;


grid-template-columns:

repeat(3,1fr);


gap:50px;


position:relative;


z-index:2;



animation:

footerShow 1s ease;



}





@keyframes footerShow{


from{

opacity:0;

transform:
translateY(50px);


}


to{


opacity:1;


transform:
translateY(0);


}



}






/* BRAND */


.footer-brand h2{


font-size:35px;


font-weight:900;


color:white;


}



.footer-brand h2 span{


color:#818cf8;


text-shadow:

0 0 20px #6366f1;


}




.footer-brand p{


color:#94a3b8;


line-height:2;


margin-top:15px;


}





/* LINKS */


.footer-links,


.footer-social{


display:flex;


flex-direction:column;


gap:18px;


}



.footer-links a,


.footer-social a{


color:#cbd5e1;


text-decoration:none;


font-weight:600;


transition:.4s;


position:relative;



}




.footer-links a:hover,


.footer-social a:hover{


color:white;


transform:

translateX(10px);


text-shadow:

0 0 20px #818cf8;



}





/* BOTTOM */


.footer-bottom{


margin-top:50px;


padding-top:25px;


text-align:center;


color:#64748b;


border-top:

1px solid rgba(255,255,255,.1);



}





/* MOBILE */


@media(max-width:800px){


.footer-container{


grid-template-columns:1fr;


text-align:center;


}



.footer-links,


.footer-social{


align-items:center;


}



}




</style>