<x-layout>
    <section class=" min-h-screen bg-[#BEC9DE] flex justify-center items-center">

        <ul class="bg-white min-w-[500px] rounded-lg shadow divide-y divide-gray-200 max-w-sm">
            @forelse($tasks as $task)

                <li class="px-6 py-4 tasks">
                    <div class="flex items-center justify-between">

                        <div>
                            <span class="font-semibold text-lg">{{$task->name}}</span>
                            <p class="text-gray-700">{{$task->description}}</p>
                        </div>

                        <div>

                            @php
                                $status = match ($task->status) {
                                    'active' => 'Актив',
                                    'completed' => 'Завершен'
                                }
                            @endphp
                            <p class="text-lg text-gray-600 font-semibold">{{$status}}</p>
                        </div>

                    </div>




                    <div class="flex gap-2 mt-4">

                        <form method="POST" action="{{route('tasks.destroy',$task->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded">
                                Delete
                            </button>
                        </form>

                        <a href="{{route('tasks.edit',$task->id)}}"
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                            Edit
                        </a>

                        <a href="{{route('tasks.status.history',$task->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                            Status history
                        </a>
                    </div>
                </li>
            @empty

            @endforelse
        </ul>
    </section>
</x-layout>