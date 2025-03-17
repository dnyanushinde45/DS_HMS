<x-doctor>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dotor / List
            </h2>
            <a class="bg-slate-700 text-sm rounded-md text-white px-3 py-2" href="{{ Route('doctordashboard') }}">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-message></x-message>

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60" >#</th>
                        <th class="px-6 py-3 text-left" >Name</th>
                        <th class="px-6 py-3 text-left" >Address</th>
                        <th class="px-6 py-3 text-left" >Phone Number</th>
                        <th class="px-6 py-3 text-left" >Department</th>
                        <th class="px-6 py-3 text-left" >Post</th>
                        <th class="px-6 py-3 text-left" width="180">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($doctorlist->isNotEmpty())
                        @foreach ($doctorlist as $doctors)
                    <tr class="border-b">
                        <td class="px-6 py-3 text-left">
                            {{$doctors->id}}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{$doctors->name}}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{$doctors->address}}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{$doctors->phonenumber}}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{$doctors->department}}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{$doctors->post}}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{\Carbon\Carbon::parse($doctors->created_at)->format('d M, Y')}}
                        </td>
                    
                        <td class="px-6 py-3 text-center">
                            <a class="bg-slate-700 text-sm rounded-md text-white px-3 py-3 hover:bg-slate-600" href="{{route('doctor.edit',$doctors->id)}}">Edit</a>
                            <button class="bg-red-700 text-sm rounded-md text-white px-3 py-3 hover:bg-red-500"
                            onclick="confirmDelete({{ $doctors->id }})">Delete</button>
                            <form id="delete-doctor-from-{{ $doctors->id }}" action="{{ route('doctor.destroy', $doctors->id) }}" method="post"  style="display: none;">
                                @csrf
                              @method('delete')
                            </form>
                        </td>
                    
                    </tr>
                    @endforeach
                    @endif
                </tbody>

            </table>
            </div>
    </div>


<div class="d-flex justify-content-center align-items-center mt-5 mb-5">
        {{ $doctorlist->links() }} <!-- Pagination  -->
        </div><br><hr><br>

    </x-doctor>

    <script>
        function confirmDelete(doctorId) {
            if (confirm("Are you sure you want to delete this doctor?")) {
                // If confirmed, submit the form to delete the doctor
                document.getElementById('delete-doctor-from-' + doctorId).submit();
            }
        }
    </script>