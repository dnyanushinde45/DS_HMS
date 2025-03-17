<head>
    <style>
  .form-field input{
    text-align: center;
  }

  .form-field select{
    text-align: center;
  }
    </style>
</head>

<x-doctor>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dotor / Create
            </h2>
            <a class="bg-slate-700 text-sm rounded-md text-white px-3 py-2" href="{{ Route('permissions.index') }}">Back</a>
        </div>
    </x-slot>

   <center><div class="py-12">
    <h2 style="font-size: 30px; font-weight: bold; padding-bottom: 20px; color: rgb(94, 179, 244);">New Doctor's Registration</h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <form action="{{ Route('doctor.storedoctor') }}" method="POST">
                    @csrf
                        <div class="form-field">
                            <label for="" class="text-lg font-medium">Doctor's Name</label>
                            <div class="my-3">
                                <input autocomplete="name" style="text-align: center;" value="{{ old('name') }}" name="name" placeholder="Enter the name" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('name')
                                <p class="text-red-400 font-medium">{{$message}}</p>
                            @enderror
                            </div>
                            <div class="form-field">
                                <label for="" class="text-lg font-medium">Email</label>
                                <div class="my-3">
                                    <input autocomplete="email" style="text-align: center;" value="{{ old('email') }}" name="email" placeholder="Enter your email" type="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('email')
                                    <p class="text-red-400 font-medium">{{$message}}</p>
                                @enderror
                                </div>
                            <div>
                                <label for="" class="text-lg font-medium">Phone Number</label>
                                <div class="my-3">
                                    <input autocomplete="tel" value="{{ old('phonenumber') }}" name="phonenumber" placeholder="Enter phone number" type="number" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('phonenumber')
                                    <p class="text-red-400 font-medium">{{$message}}</p>
                                @enderror
                                </div>
                                <div>
                                    <label for="" class="text-lg font-medium">Address</label>
                                    <div class="my-3">
                                        <input value="{{ old('address') }}" name="address" placeholder="Enter Your address" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                    @error('address')
                                        <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror 
                                    </div>
                                    <div>
                                        <label for="" class="text-lg font-medium">Blood Group</label>
                                        <div class="my-3">
                                            <input value="{{ old('bloodgroup') }}" name="bloodgroup" placeholder="Enter your bloodgroup" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                        @error('bloodgroup')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                        @enderror
                                        </div>
                                        <div>
                                            <label for="" class="text-lg font-medium">Department</label>
                                            <div class="my-3">
                                                <input value="{{ old('department') }}" name="department" placeholder="Enter Your department" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                            @error('department')
                                                <p class="text-red-400 font-medium">{{$message}}</p>
                                            @enderror
                                            </div>
                                            <div>
                                                <label for="" class="text-lg font-medium">Post</label>
                                                <div class="my-3">
                                                    <input value="{{ old('post') }}" name="post" placeholder="Enter your post" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                                @error('post')
                                                    <p class="text-red-400 font-medium">{{$message}}</p>
                                                @enderror
                                                </div>

                                               <div>
                                                    <label for="gender" class="text-lg font-medium">Gender</label>
                                                    <div class="my-3">
                                                        <select name="gender" id="gender" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                                            <option value="">Select Gender</option>
                                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                                        </select>
                                                        
                                                        @error('gender')
                                                            <p class="text-red-400 font-medium">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                      <div>
                                                        <label for="" class="text-lg font-medium">Password</label>
                                                        <div class="my-3">
                                                            <input autocomplete="new-password" value="{{ old('password') }}" name="password" placeholder="Enter your password" type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                                        @error('password')
                                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                                        @enderror
                                                        </div>

                                                       {{-- <div class="mb-3">
                                                            <label for="formFile" class="form-label">Default file input example</label>
                                                            <input id="input-b1" name="image" type="file" class="file" data-browse-on-zone-click="true">                                                          
                                                            @error('image')
                                                                <p class="text-red-400 font-medium">{{$message}}</p>
                                                            @enderror
                                                            </div>  --}}

                            <br><br><button class="bg-slate-700 text-sm rounded-md text-white px-6 py-3 " style="font-size: 20px; background-color: rgb(30, 210, 48);">Submit</button>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</center>
</x-doctor>

{{-- for doctor count --}}
<script>
    document.addEventListener("DOMContentLoaded", function(){
        fetch("/doctor-count")
        .then(response => response.json())
        .then(data => {
            document.getElementById('doctor-count').innerText = data.doctor_count;
        })
        catch(error => console.error("error to fetch", error));
    });
</script>