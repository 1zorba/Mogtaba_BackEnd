@extends('layouts.app')

@section('title','تسجيل الدخول')


@section('content')


<div class="min-h-screen flex items-center justify-center px-6 py-10">


<div class="w-full max-w-md">

@if(session('error'))

<div class="error-alert mb-6">


<div class="error-icon">

⚠️

</div>


<div>

<h3>

خطأ في تسجيل الدخول

</h3>


<p>

{{ session('error') }}

</p>


</div>


</div>


@endif


<div class="bg-slate-900/80 backdrop-blur-xl 
border border-slate-700 
rounded-[35px] 
p-10 shadow-2xl">


<!-- Logo -->

<div class="text-center mb-8">


<div class="w-24 h-24 mx-auto rounded-full 
bg-indigo-600 
flex items-center justify-center 
text-5xl shadow-lg">

🔐

</div>


<h1 class="text-3xl font-black text-white mt-6">

تسجيل الدخول

</h1>


<p class="text-slate-400 mt-3">

ادخل بيانات حسابك للوصول للنظام

</p>


</div>



<form method="POST" action="{{ route('login.post') }}">

@csrf



<!-- Email -->


<div class="mb-6">


<label class="block text-white font-bold mb-3">

البريد الإلكتروني

</label>


<input

type="email"

name="email"

value="{{ old('email') }}"

class="w-full px-5 py-4 rounded-2xl 
bg-slate-950 
border border-slate-700 
text-white 
focus:border-indigo-500 
outline-none transition"

placeholder="example@email.com"

required>


@error('email')

<p class="text-red-400 text-sm mt-2">

{{ $message }}

</p>

@enderror


</div>





<!-- Password -->


<div class="mb-8">


<label class="block text-white font-bold mb-3">

كلمة المرور

</label>


<input

type="password"

name="password"

class="w-full px-5 py-4 rounded-2xl 
bg-slate-950 
border border-slate-700 
text-white 
focus:border-indigo-500 
outline-none transition"

placeholder="********"

required>


@error('password')

<p class="text-red-400 text-sm mt-2">

{{ $message }}

</p>

@enderror


</div>





<button

type="submit"

class="w-full py-4 rounded-2xl

bg-gradient-to-r from-indigo-600 to-purple-600

hover:from-indigo-700 hover:to-purple-700

text-white

font-black

text-lg

transition

hover:-translate-y-1">


دخول


</button>



</form>




<div class="text-center mt-8">


<p class="text-slate-400">

ليس لديك حساب ؟

{{-- <a href="{{ route('register') }}"

class="text-indigo-400 font-bold hover:text-indigo-300"> --}}

إنشاء حساب

</a>

</p>


</div>


</div>


</div>


</div>


@endsection

<style>
    .error-alert{

display:flex;

align-items:center;

gap:15px;

background:
rgba(239,68,68,.15);

border:1px solid rgba(239,68,68,.4);

backdrop-filter:blur(15px);

padding:18px;

border-radius:25px;

color:white;

animation:
shake .5s ease,
fadeIn .4s ease;

box-shadow:
0 15px 40px rgba(239,68,68,.25);

}



.error-icon{

width:55px;

height:55px;

display:flex;

align-items:center;

justify-content:center;

background:
rgba(239,68,68,.2);

border-radius:50%;

font-size:28px;

animation:pulseError 1.5s infinite;

}



.error-alert h3{

font-size:18px;

font-weight:900;

color:#f87171;

margin-bottom:5px;

}



.error-alert p{

color:#fecaca;

font-size:14px;

}



@keyframes shake{


0%,100%{

transform:translateX(0);

}


20%{

transform:translateX(-8px);

}


40%{

transform:translateX(8px);

}


60%{

transform:translateX(-5px);

}


80%{

transform:translateX(5px);

}


}



@keyframes fadeIn{


from{

opacity:0;

transform:translateY(-20px) scale(.95);

}


to{

opacity:1;

transform:translateY(0) scale(1);

}


}



@keyframes pulseError{


0%{

box-shadow:
0 0 0 0 rgba(239,68,68,.5);

}


70%{

box-shadow:
0 0 0 18px rgba(239,68,68,0);

}


100%{

box-shadow:
0 0 0 0 rgba(239,68,68,0);

}


}
</style>