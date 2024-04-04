<x-layout>

    <section class=" min-h-screen bg-[#BEC9DE] flex justify-center items-center">

        <div class="p-8 lg:mt-0 rounded shadow bg-white w-[600px] h-fit ">

            <form action="{{route('tasks.update',$task->id)}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="md:flex mb-8 items-center">
                    <div class="md:w-1/3">
                        <label for="name" class="block text-black font-bold md:text-left mb-3 md:mb-0 pr-4">
                            Название задачи
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="name" value="{{$task->name}}" id="name"
                               class="block w-full bg-[#BEC9DE] outline-none px-4 py-2 font-semibold" type="text"/>
                        @error("name")
                        <p class="text-base text-center pt-2 text-red-600 font-semibold">{{$message}}</p>
                        @enderror
                    </div>
                </div>


                <div class="md:flex mb-8">
                    <div class="md:w-1/3">
                        <label class="block text-black font-bold md:text-left mb-3 md:mb-0 pr-4" for="summernote">
                            Описание задачи
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <textarea name="description" id="summernote"
                                  class="  block w-full outline-none bg-[#BEC9DE] px-4 py-2 font-semibold"
                                  rows="8">{{$task->description}}</textarea>
                        @error("description")
                        <p class="text-base pt-2 text-center text-red-600 font-semibold">{{$message}}</p>
                        @enderror
                    </div>
                </div>


                <div class="md:flex mb-8">
                    <div class="md:w-1/3">
                        <label class="block text-black font-bold md:text-left mb-3 md:mb-0 pr-4" for="status">
                            Статус
                        </label>
                    </div>
                    <div class="md:w-2/3 flex flex-col items-center">
                        <select id="status" name="status" class="block w-full outline-none bg-[#BEC9DE] px-4 py-2 font-semibold">
                            <option value="active" {{ $task->status === 'active' ? 'selected' : '' }}>Актив</option>
                            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Завершить</option>
                        </select>
                        @error("status")
                        <p class="text-base pt-2 text-center text-red-600 font-semibold">{{$message}}</p>
                        @enderror
                    </div>
                </div>


                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button
                                class="shadow bg-blue-700 hover:bg-blue-800 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded active:scale-95"
                                type="submit">
                            Редактировать
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </section>


</x-layout>