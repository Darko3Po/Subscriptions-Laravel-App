<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-4/5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <form action="{{route('subscriptions')}}" method="POST" id="card-form" class="w-4/5">
                            {{ csrf_field() }}
                            <div>
                                <x-input-label for="card-holder-name" :value="__('Name of card')" />
                                <x-text-input id="card-holder-name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="card" :value="__('Card details')" />
                                <div id="card-element"></div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button id="card-button" class="ms-3" data-secrect="{{ $intent->client_secret }}" >
                                    Pay
                                </x-primary-button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
{{--    {{ config('cashier.key')  }}    --}}
{{--    STRIPE_KEY=pk_test_51OfHGtDbT4THc2zuZG7YOK6slxOuSKrSKQFMT4B5SjPoljmGoYmoOg1NXO6e91sBNdKBHMHCvPP7dLp25dKmiPV200NqngSJUr--}}
    <script>
        const strip = Stripe('{{ config('cashier.key') }}')
        const elements = strip.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const form = document.getElementById('card-form')
        const cardButton = document.getElementById('card-button')
        const cardHolderName = document.getElementById('card-holder-name')


        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            cardButton.disabled = true

            const {setupIntent, error} = await strip.confirmCardSetup(
                cardButton.dataset.secrect, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            )



                let token = document.createElement('input');

                token.setAttribute('type','hidden');
                token.setAttribute('name','token');
                token.setAttribute('value', setupIntent.payment_method);

                form.submit();



            //
            // console.log(setupIntent)
            // console.log(error)

        })


    </script>

</x-app-layout>
