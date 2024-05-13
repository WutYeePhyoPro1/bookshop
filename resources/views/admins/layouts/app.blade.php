<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <style>
        body{
            font-family: sans-serif;
        }
        .solid {
            border: 2px red solid!important;
            border-radius: 10px!important;
        }
        table.dataTable tbody tr{
            font-size: 12px!important;
        }
        .tab-active
        {
            border-bottom: 2px #0e7490 solid!important;
        }
        .ts-control{
            overflow: auto!important;
            height: 50px!important;
        }

    </style>
</head>
<body class="h-full"  x-data="{ openMenu: false,sideBarMenu:true, addDept:false,addPosition:false,addBranch:false, addRole:false, addPermission:false,addUser:false,addTeam:false }"
>
<div class="min-h-full font-roboto">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    @include('admins.layouts.nav')
    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col" x-show="sideBarMenu">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex flex-grow flex-col overflow-y-auto bg-cyan-100 pt-5 pb-4">
        <nav class="mt-3 flex flex-1 flex-col divide-y divide-cyan-800 bg-cyan-700 overflow-y-auto" aria-label="Sidebar">
          <div class="space-y-1 px-2">
            <!-- Current: "bg-cyan-800 text-white", Default: "text-cyan-100 hover:text-white hover:bg-cyan-600" -->
            <a href="#" class="bg-cyan-800 text-white group flex items-center p-2 mt-3 text-sm leading-6 font-medium rounded-md" aria-current="page">
              <!-- Heroicon name: outline/home -->
              <svg class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
              </svg>
              Dashboard
            </a>

            <a href="{{ route('books.index') }}" class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
              <!-- Heroicon name: outline/clock -->
              <svg class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Books
            </a>             
          </div>         
        </nav>
      </div>
    </div>

    <div class="flex flex-1 flex-col lg:pl-64">
      <div class="flex h-20 flex-shrink-0 border-b border-gray-200 bg-cyan-100 lg:border-none">
        <!-- Search bar -->

        <div class="flex flex-1 justify-between px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
            <div class="ml-4 flex items-center md:ml-6">
                <img class="h-12 lg:hidden" src="{{ asset('img/finallogo.png') }}" alt="">
            </div>
          <div class="ml-4 flex justify-end items-center md:ml-6">
            <button type="button" class="block lg:hidden bg-white p-1 text-gray-400 hover:text-gray-500" x-on:click.prevent="openMenu = !openMenu">
                <span class="sr-only">Mobile Menu</span>
                <!-- Heroicon name: outline/menu -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                  </svg>
              </button>

            <!-- Profile dropdown -->
            <div class="relative ml-3" x-data="{admindropdownMenu: false}"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" >
              <div>
                <button type="button" @click="admindropdownMenu = ! admindropdownMenu" class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 lg:rounded-md lg:p-2 lg:hover:bg-gray-50" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                  <span class="ml-3 hidden text-sm font-medium text-gray-700 lg:block"><span class="sr-only">Open user menu for </span>{{ getAuthUser()->name}}</span>
                  <!-- Heroicon name: mini/chevron-down -->
                  <svg class="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                  </svg>
                </button>
              </div>
              <div x-show="admindropdownMenu" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">               
                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <main class="flex-1 pb-8 mt-4">
        <!-- Page header -->
        {{-- {{ Auth::user()->name }} --}}
       @yield('content')
      </main>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@stack('addon-script')
<script>
    function closeModal(modal)
       {
           $(modal).hide();
       }
       function openModal(modal)
       {
           $(modal).show();
       }
</script>
@yield('script')
</body>
</html>
