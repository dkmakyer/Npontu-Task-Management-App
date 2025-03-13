<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <x-sidebar :user="auth()->user()"></x-sidebar>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-end items-center mb-8">
                <div class="text-sm">
                    <span>{{ date('l') }}</span><br>
                    <span>{{ date('d/m/Y') }}</span>
                </div>
            </div>

            <!-- Help Section -->
            <div class="bg-white p-6 rounded shadow">
                <div class="space-y-4">
                    <a href="https://help.clickup.com/hc/en-us/articles/360004451812-Getting-Started-with-ClickUp"
                        class="block bg-red-400 text-white p-4 rounded text-center cursor-pointer">Getting Started</a>
                    <a href="https://community.atlassian.com/t5/Jira/ct-p/jira"
                        class="block bg-red-400 text-white p-4 rounded text-center cursor-pointer">Community Support And
                        Resources</a>
                    <a href="https://help.clickup.com/hc/en-us/categories/360001977091-FAQs-Troubleshooting"
                        class="block bg-red-400 text-white p-4 rounded text-center cursor-pointer">Troubleshooting &
                        FAQs</a>
                    <a href="https://community.atlassian.com/t5/Trello-questions/How-do-I-submit-a-feature-request/qaq-p/1367937"
                        class="block bg-red-400 text-white p-4 rounded text-center cursor-pointer">User Feedback</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
