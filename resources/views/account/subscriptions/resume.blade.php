<x-account-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            Resume Subscriptions

            <form action="{{route('account.subscriptions.resume')}}" method="POST">
                {{csrf_field()}}

                <x-primary-button class="ms-3">
                    {{ __('Resume') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-account-layout>
