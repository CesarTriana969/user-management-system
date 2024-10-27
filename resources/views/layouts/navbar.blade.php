<style>
    .transition-height {
        transition: max-height 1s ease-out;
        overflow: hidden;
        max-height: 0;
    }

    .transition-height.open {
        max-height: 10em;
    }

    #arrow-icon {
        transition: transform 0.5s ease-out;
    }

    #arrow-icon.open {
        transform: rotate(90deg);
    }

    .transition-height {
        width: 100%;
    }
</style>

<div class="w-64 absolute sm:relative bg-[#112D55] shadow md:h-full flex-col justify-between hidden sm:flex z-50 max-[768px]:h-screen" style="
            -webkit-box-shadow: 17px -1px 32px -18px rgba(0,0,0,0.45);
            -moz-box-shadow: 17px -1px 32px -18px rgba(0,0,0,0.45);
            box-shadow: 17px -1px 32px -18px rgba(0,0,0,0.45);
            min-height: 716px
" id="system_navbar">

    <div class="px-2">
        <a href="/">
            <img src="{{asset('images/logos/logo.png')}}" alt="IMG" class="h-fit w-16 flex items-center mx-auto mt-3 pt-4" >
        </a>

        <ul class="mt-10 nav__item-system">
            <li class="flex ml-2 w-full justify-between text-white hover:text-gray-200 cursor-pointer items-center mb-2 ">
                <a href="{{ route('home') }}" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white hover:bg-gray-700 px-3 py-2 rounded w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                    </svg>
                    <span class="text-sm font-medium ml-2">Dashboard</span>
                </a>
            </li>

            @canany(['view-users', 'view-roles'])
                <p class="text-xs ml-1 mt-6 text-white">Settings</p>
            @endcanany

            @can('view-users')
            <li class="flex ml-2 w-full justify-between text-white hover:text-gray-200 cursor-pointer items-center mb-2">
                <a href="/system/users" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white hover:bg-gray-700 px-3 py-2 rounded w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32" fill="white">
                        <path fill="currentColor" d="M8 5c-3.3 0-6 2.7-6 6c0 2 1 3.8 2.5 4.8C1.8 17.2 0 19.9 0 23h2c0-3.3 2.7-6 6-6s6 2.7 6 6h2c0-3.2 2.6-5.9 5.8-6h.2c2.5 0 4.6-1.5 5.5-3.6c0 0 0-.1.1-.1c.1-.1.1-.3.1-.4c0-.1 0-.1.1-.2c0-.1.1-.3.1-.4c0-.1 0-.2.1-.3c0-.1 0-.2.1-.3v-.6c0-3.3-2.7-6-6-6s-6 2.7-6 6c0 2 1 3.8 2.5 4.8c-1.5.7-2.7 1.9-3.5 3.3c-.8-1.4-2-2.6-3.5-3.3C13 14.8 14 13 14 11c0-3.3-2.7-6-6-6zm0 2c2.2 0 4 1.8 4 4s-1.8 4-4 4s-4-1.8-4-4s1.8-4 4-4zm14 0c2.2 0 4 1.8 4 4s-1.8 4-4 4s-4-1.8-4-4s1.8-4 4-4zm2.1 11v2.1c-.6.1-1.2.4-1.7.7l-1.5-1.5l-1.4 1.4l1.5 1.5c-.4.5-.6 1.1-.7 1.8H18v2h2.1c.1.6.4 1.2.7 1.8l-1.5 1.5l1.4 1.4l1.5-1.5c.5.3 1.1.6 1.7.7V32h2v-2.1c.6-.1 1.2-.4 1.7-.7l1.5 1.5l1.4-1.4l-1.5-1.5c.4-.5.6-1.1.7-1.8H32v-2h-2.1c-.1-.6-.4-1.2-.7-1.8l1.5-1.5l-1.4-1.4l-1.5 1.5c-.5-.3-1.1-.6-1.7-.7V18h-2zm.9 4c1.7 0 3 1.3 3 3s-1.3 3-3 3s-3-1.3-3-3s1.3-3 3-3zm0 2a.872.872 0 0 0-.367.086a1.138 1.138 0 0 0-.32.227a1.138 1.138 0 0 0-.227.32A.872.872 0 0 0 24 25c0 .125.031.25.086.367c.055.117.133.227.227.32c.093.094.203.172.32.227A.872.872 0 0 0 25 26c.5 0 1-.5 1-1s-.5-1-1-1z"/></svg>
                        <span class="text-sm font-medium ml-2">Users</span>
                    </a>
                </li>
            @endcan

            @can('view-roles')
            <li class="flex ml-2 w-full justify-between text-white hover:text-gray-200 cursor-pointer items-center">
                <a href="{{ route('role') }}" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white hover:bg-gray-700 px-3 py-2 rounded w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48" fill="white">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="4"><path stroke-linejoin="round" d="M20 10H6a2 2 0 0 0-2 2v26a2 2 0 0 0 2 2h36a2 2 0 0 0 2-2v-2.5"/><path d="M10 23h8m-8 8h24"/><circle cx="34" cy="16" r="6" stroke-linejoin="round"/><path stroke-linejoin="round" d="M44 28.419C42.047 24.602 38 22 34 22s-5.993 1.133-8.05 3"/></g></svg>
                    <span class="text-sm font-medium ml-2">Roles</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>

<script>
  function toggleDropdown() {
    var dropdown = document.getElementById('dropdown');
    var arrowIcon = document.getElementById('arrow-icon');

    if (dropdown.classList.contains('open')) {
      dropdown.classList.remove('open');
      arrowIcon.classList.remove('open');
    } else {
      dropdown.classList.add('open');
      arrowIcon.classList.add('open');
    }
  }

  function toggleDropdown2() {
    var dropdown = document.getElementById('dropdown2');
    var arrowIcon = document.getElementById('arrow-icon');

    if (dropdown.classList.contains('open')) {
      dropdown.classList.remove('open');
      arrowIcon.classList.remove('open');
    } else {
      dropdown.classList.add('open');
      arrowIcon.classList.add('open');
    }
  }
</script>


