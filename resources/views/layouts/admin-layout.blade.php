<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iGarchu</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')

</head>

<body class="lg:gap-4 lg:flex h-screen custom-height" style="height: 2100px !important;">

   

   @if(!session('login'))
    @php
        header("Location: /login");
        exit();
    @endphp
@endif



    <div class="lg:h-full lg:overflow-hidden z-10 bg-gray-800">
        {{-- When in small screen --}}
        <button id="sidebarToggle" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-300 rounded-lg lg:hidden  focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
    
        <div id="default-sidebar" class="lg:hidden fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full lg:translate-x-0" aria-label="Sidebar">
            <div class="flex justify-between items-center p-4 bg-gray-00">
                <h1 class="text-[#80461B] text-2xl font-bold">iGarchu</h1>
                <button id="sidebarClose" class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
               <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('users') }}" class="@if(Route::currentRouteName() == 'users') bg-[#613b16]  @endif flex items-center p-2 text-white rounded-lg   dark:hover:bg-gray-700 group">
                       <svg class="flex-shrink-0 w-5 h-5  transition duration-75 text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                          <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                       </svg>
                       <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
                 </li>
                  <li>
                     <a href="{{ route('donations') }}"class="@if(Route::currentRouteName() == 'donations') bg-[#613b16]  @endif flex items-center p-2 text-white rounded-lg   dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5  transition duration-75 text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                           <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Donations</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('requests') }}" class="@if(Route::currentRouteName() == 'requests') bg-[#613b16]  @endif flex items-center p-2 text-white  rounded-lg  hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5  transition duration-75  text-gray-300  group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                           <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">User Requests</span>
                     </a>
                  </li>
                  <li class="cursor-pointer">
                     <a class="flex items-center p-2 text-white rounded-lg   dark:hover:bg-gray-700 group" onclick="logout()">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                     </a>

                      
                  </li>
                  
               </ul>
            </div>
         </div>

         {{-- Higher Screen --}}
         <aside id="default-sidebar" class="lg:block hidden z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
            <div class="flex justify-between items-center p-4 bg-orange-200">
                <!-- <h1 class="text-[#80461B] text-2xl font-bold">iGarchu</h1> -->
                <div class="flex justify-center flex-col items-center">
          <img src="{{ asset('image/igarchuLogo.png') }}" alt="Example Image" style="width: 230px; height: 200px;">
        </div>
                <button id="sidebarClose" class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="h-full px-3 py-4 overflow-y-auto bg-[#613b16] ">
               <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('users') }}" class="@if(Route::currentRouteName() == 'users') bg-[#D63930] @endif flex items-center p-2 text-white rounded-lg hover:bg-[#D63930] group">
                       <svg class="flex-shrink-0 w-5 h-5  transition duration-75 text-gray-30 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                          <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                       </svg>
                       <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
                 </li>
                  <li>
                     <a href="{{ route('donations') }}"class="@if(Route::currentRouteName() == 'donations') bg-[#D63930]  @endif flex items-center p-2 text-white rounded-lg hover:bg-[#D63930] group">
                        <svg class="flex-shrink-0 w-5 h-5  transition duration-75 text-gray-300 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                           <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Donations</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('requests') }}" class="@if(Route::currentRouteName() == 'requests') bg-[#D63930]  @endif flex items-center p-2 text-white  rounded-lg hover:bg-[#D63930]">
                        <svg class="flex-shrink-0 w-5 h-5  transition duration-75  text-gray-300  group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                           <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">User Requests</span>
                     </a>
                  </li>
                  <li>
                     <a class="flex items-center p-2 text-white rounded-lg   dark:hover:bg-[#D63930] group" onclick="logout()">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-[#D63930] dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                     </a>
                  </li>
                  
               </ul>
            </div>
         </aside>
    </div>

    <main id="mainContent" class="py-6 w-full lg:w-[85vw] ">
        @yield('content')
    </main>

    <script>
         function logout() {
            window.location.href="/api/logout"
         }

               document.getElementById('sidebarToggle').addEventListener('click', function () {
                     toggleSidebar();
               });

               document.getElementById('sidebarClose').addEventListener('click', function () {
                     toggleSidebar();
               });

               function toggleSidebar() {
                     var sidebar = document.getElementById('default-sidebar');
                     sidebar.style.transform = sidebar.style.transform === 'translateX(0px)' ? 'translateX(-100%)' : 'translateX(0px)';
               }
         
    </script>
</body>
</html>