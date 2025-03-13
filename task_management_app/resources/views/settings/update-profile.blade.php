<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        To-Do App
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex flex-col h-screen">
        <!-- Header -->
        <x-header :pageName="'Profile'"></x-header>

        <div class="flex flex-1 pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()"></x-sidebar>

            <!-- Main Content -->
            <div class="flex-1 p-6 ml-72">
                <!-- Account Information -->
                <div class="bg-white p-6 rounded shadow">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">
                            Account Information
                        </h2>
                    </div>
                    <div class="flex items-center mb-6">
                        <img alt="User profile picture" class="rounded-full w-12 h-12 mr-4" height="50"
                            src="https://placehold.co/50x50" width="50" />
                        <div>
                            <p class="font-semibold">
                                {{ $user->first_name }}
                            </p>
                            <p class="text-sm">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('store.update') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <input class="border rounded p-2" placeholder="First Name" type="text"
                                name="first_name" />
                            <input class="border rounded p-2" placeholder="Last Name" type="text" name="last_name" />
                            <input class="border rounded p-2" placeholder="Email Address" type="email"
                                name="email" />
                        </div>
                        <div class="flex justify-end mt-6">
                            <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" type="submit">
                                Save Changes
                            </button>
                            <a href="{{ route('cancel.update') }}">
                                <button class="bg-gray-300 text-black px-4 py-2 rounded" type="button">
                                    Cancel
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
