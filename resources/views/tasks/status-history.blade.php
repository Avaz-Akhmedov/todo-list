<x-layout>


    <div class="h-100 w-full flex items-center justify-center mt-16 bg-teal-lightest font-sans">
        <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
            <div class="mb-4">
                <h1 class="text-green-500 text-2xl font-bold">История статусов</h1>
            </div>
            <div>
                @foreach($statusHistory as $item)

                    @php
                        $status = match ($item->status) {
                            'active' => 'Актив',
                            'completed' => 'Завершен'
                        }
                    @endphp
                    <div class="flex mb-4 items-center">
                        <p class="w-full text-black text-xl font-semibold"> - {{$status}}</p>
                        <p class="w-full text-gray-500 text-xl font-semibold">  {{$item->created_at}}</p>

                    </div>
                @endforeach

            </div>
        </div>
    </div>

</x-layout>