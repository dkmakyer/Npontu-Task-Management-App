<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Change Password
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <div class="flex flex-col h-screen">
        <!-- Header -->
        <x-header :pageName="'Change Password'"></x-header>
        <div class="flex flex-1 pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="$user"></x-sidebar>

            <!-- Main Content -->
            <div class="flex-1 p-6 ml-72">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-red-500">
                            Change Password
                        </h2>
                    </div>
                    <div class="flex items-center mb-6">
                        <img alt="User profile picture" class="rounded-full w-12 h-12 mr-4" height="50"
                            src="{{ $user->getImgUrl() }}" width="50" />
                        <div>
                            <p class="font-bold">
                                {{ $user->first_name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('change.password') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700" for="current-password">
                                Current Password
                            </label>
                            <input class="w-full p-2 border rounded" id="current-password" type="password"
                                name="old_password" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700" for="new-password">
                                New Password
                            </label>
                            <input class="w-full p-2 border rounded" id="new-password" type="password"
                                name="password" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700" for="confirm-password">
                                Confirm Password
                            </label>
                            <input class="w-full p-2 border rounded" id="confirm-password" type="password"
                                name="password_confirmation" />
                        </div>
                        <div class="flex space-x-4">
                            <button class="bg-red-500 text-white px-4 py-2 rounded" type="submit">
                                Update Password
                            </button>
                            <button class="bg-gray-300 text-black px-4 py-2 rounded" type="button">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/task.js') }}"></script>

</body>

</html>
