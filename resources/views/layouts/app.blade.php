<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'dansksprog.docs') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/app.css">

</head>
<body class="font-sans">
    <div id="app">
       <div class="container px-6">
           <header class="py-6 mb-8">
               <h1>
                   dansksprog.docs
               </h1>
           </header>
           <main class="flex">
            <aside class="w-64 pt-8">
                <section class="mb-8">
                    <h5 class="uppercase font-bold mb-3 text-base">
                        Navigation
                    </h5>
                    <ul class="list-reset">
                        <li class="text-sm pb-4"><router-link class="text-black" to="/" exact>Home</router-link></li>
                        <li class="text-sm pb-4"><router-link class="text-black" to="/about">About</router-link></li>
                    </ul> 
                </section>                                               
            </aside>
            <div class="primary flex-1">
                    <router-view></router-view>
            </div>   
           </main>           
       </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
