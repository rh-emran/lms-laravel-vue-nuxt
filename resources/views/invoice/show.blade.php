<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Invoice') }}
            </h2>

            <a class="lms-btn" href="{{ route('invoice.index') }}">back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- component -->
                <livewire:invoice-show :invoice_id="$invoice->id" />

                @if ($invoice->amount()['due'] > 0)
                    <div class="px-12 mb-4">
                        <h2 class="font-bold mb-2">Add a payment</h2>
                        <form method="post" action="{{ route('stripe-payment') }}">@csrf
                            <div class="flex mb-4">
                                <div class="w-full">
                                    <input name="card_no" value="4242424242424242" type="number" class="lms-input"
                                        placeholder="Card number">
                                </div>

                                <div class="min-w-max ml-4">
                                    <input name="card_expiry_date" value="12/30" type="text" class="lms-input"
                                        placeholder="Expiry month/year">
                                </div>

                                <div class="min-w-max ml-4">
                                    <input name="card_ccv" value="1234" type="text" class="lms-input"
                                        placeholder="CCV">
                                </div>

                                <div class="min-w-max ml-4">
                                    <input name="amount" type="number" class="lms-input"
                                        value="{{ number_format($invoice->amount()['due'], 2) }}" placeholder="Amount">
                                </div>
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                            </div>
                            <button type="submit" class="lms-btn">Pay Now</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
