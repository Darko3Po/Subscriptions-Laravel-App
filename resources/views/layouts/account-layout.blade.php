<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Account
        </h2>
    </x-slot>


        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 md:space-y-0 md:grid grid-cols-8 gap-6">
          <div class="col-span-2 space-y-3">
              <ul class="mb-10">
                  <li><a href="{{ route('account') }}" class="hover:text-blue-500">Account</a></li>
              </ul>
              <ul class="mb-10">
                  <li><a href="{{ route('account.subscriptions') }}" class="hover:text-blue-500">Subscription</a></li>
              </ul>

              @if(auth()->user()->subscribed())
                  @if(!auth()->user()->subscription('default')->canceled() )
                      <ul class="mb-10">
                          <li><a href="{{ route('account.subscriptions.cancel') }}" class="hover:text-blue-500">Cancle Subscription</a></li>
                      </ul>
                 @endif

                      @if(auth()->user()->subscription('default')->canceled() )
                          <ul class="mb-10">
                              <li><a href="{{ route('account.subscriptions.resume') }}" class="hover:text-blue-500">Resume Subscription</a></li>
                          </ul>
                      @endif

              @endif

          </div>
            <div class="col-span-6">
                {{ $slot }}
            </div>
        </div>


</x-app-layout>
