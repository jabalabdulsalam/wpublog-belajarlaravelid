<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <div class="shrink-0">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company"
            class="size-8" />
        </div>
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <x-my-nav-link href="/" :current="request()->is('/')">Home</x-my-nav-link>
            <x-my-nav-link href="/posts" :current="request()->is('posts')">Blog</x-my-nav-link>
            <x-my-nav-link href="/about" :current="request()->is('about')">About</x-my-nav-link>
            <x-my-nav-link href="/contact" :current="request()->is('contact')">Contact</x-my-nav-link>
          </div>
        </div>
      </div>
      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">

          <!-- Profile dropdown -->
          <el-dropdown class="relative ml-3">
            @if(Auth::check())
            <button
              class="relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">Open user menu</span>
              <img
                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/default-avatar.jpg') }}"
                alt="{{ Auth::user()->name }}" class="size-8 rounded-full outline -outline-offset-1 outline-white/10" />
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-300">{{ Auth::user()->name }}</p>
              </div>
              <div class="ms-1 text-gray-300">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </div>
            </button>
            @else
            <a href="{{ route('login') }}"
              class="rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-white/20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Log
              in</a>
            <span class="mx-2 text-white">|</span>
            <a href="{{ route('register') }}"
              class="rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-white/20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Register</a>
            @endif
            <el-menu anchor="bottom end" popover
              class="w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
              <a href="/profile"
                class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">Your
                profile</a>
              <a href="/dashboard"
                class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">Settings</a>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit"
                  class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden cursor-pointer">Log
                  out</button>
              </form>
            </el-menu>
          </el-dropdown>
        </div>
      </div>
      <div class="-mr-2 flex md:hidden">
        <!-- Mobile menu button -->
        <button type="button" command="--toggle" commandfor="mobile-menu"
          class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
            aria-hidden="true" class="size-6 in-aria-expanded:hidden">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
            aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <el-disclosure id="mobile-menu" hidden class="block md:hidden">
    <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
      <x-my-nav-link class='block' href="/" :current="request()->is('/')">Home</x-my-nav-link>
      <x-my-nav-link class='block' href="/posts" :current="request()->is('posts')">Posts</x-my-nav-link>
      <x-my-nav-link class='block' href="/about" :current="request()->is('about')">About</x-my-nav-link>
      <x-my-nav-link class='block' href="/contact" :current="request()->is('contact')">Contact</x-my-nav-link>
    </div>
    <div class="border-t border-white/10 pt-4 pb-3">
      @if (Auth::check())
      <div class="flex items-center px-5">
        <div class="shrink-0">
          <img
            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/default-avatar.jpg') }}"
            alt="{{ Auth::user()->name }}" class="size-10 rounded-full outline -outline-offset-1 outline-white/10" />
        </div>
        <div class="ml-3">
          <div class="text-base/5 font-medium text-white">{{ Auth::user()->name }}</div>
        </div>
      </div>
      <div class="mt-3 space-y-1 px-2">
        <a href="/profile"
          class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white cursor-pointer">Your
          profile</a>
        <a href="/dashboard"
          class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white cursor-pointer">Settings</a>
        <form action="/logout" method="POST">
          @csrf
          <button type="submit"
            class="w-full text-start block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white cursor-pointer">Log
            out</button>
        </form>
      </div>
      @else
      <div class="my-2 space-y-1 px-5">
        <a href="{{ route('login') }}"
          class="w-full text-start block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white cursor-pointer">Log
          in</a>
        <a href="{{ route('register') }}"
          class="w-full text-start block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white cursor-pointer">Register</a>
      </div>
      @endif
    </div>
  </el-disclosure>
</nav>