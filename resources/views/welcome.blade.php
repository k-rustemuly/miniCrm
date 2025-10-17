<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('widget.title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-semibold text-center mb-6">@lang('widget.title')</h1>

        <form id="feedbackForm" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">@lang('widget.name')<span class="text-red-500">*</span></label>
                <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 p-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">@lang('widget.phone')<span class="text-red-500">*</span></label>
                <input id="phone" type="tel" name="phone" required placeholder="+7XXXXXXXXXX" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 p-2" inputmode="tel" autocomplete="tel" value="+7">
                <p id="phoneError" class="hidden text-sm text-red-500 mt-1">@lang('widget.phone_help')</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">@lang('widget.email')<span class="text-red-500">*</span></label>
                <input type="email" name="email" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 p-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">@lang('widget.subject')<span class="text-red-500">*</span></label>
                <input type="text" name="subject" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 p-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">@lang('widget.message')<span class="text-red-500">*</span></label>
                <textarea name="message" rows="4" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 p-2"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">@lang('widget.attachment')</label>
                <input type="file" name="attachment"
                    class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none p-1">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition">
                @lang('widget.submit')
            </button>
        </form>

        <div id="successMessage" class="hidden mt-4 text-green-600 font-medium text-center">@lang('widget.success')</div>
    </div>

    <script>
        const form = document.getElementById('feedbackForm');
        const messageBox = document.getElementById('successMessage');
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phoneError');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const val = normalizePhoneValue(phoneInput.value);
            if (!E164_REGEX.test(val)) {
                e.preventDefault();
                phoneInput.classList.add('border-red-500');
                phoneError.classList.remove('hidden');
                phoneInput.focus();
                return;
            }
            phoneInput.value = val;

            const formData = new FormData(form);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/api/tickets', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (response.ok) {
                    form.reset();
                    messageBox.classList.remove('hidden');
                    setTimeout(() => messageBox.classList.add('hidden'), 4000);
                } else {
                    const result = await response.json();
                    alert('Ошибка: ' + (result.message || 'не удалось отправить'));
                }

            } catch (err) {
                console.error(err);
                alert('Ошибка сети, попробуйте позже.');
            }
        });

        const E164_REGEX = /^\+[1-9]\d{1,14}$/;

        function normalizePhoneValue(val) {
            if (!val) return '';
            val = val.trim();
            val = val.replace(/＋/g, '+');
            val = val.replace(/[^\d+]/g, '');
            if (val.indexOf('+') > 0) {
                val = val.replace(/\+/g, '');
                val = '+' + val;
            }
            return val;
        }

        phoneInput.addEventListener('input', (e) => {
            const pos = phoneInput.selectionStart;
            let value = phoneInput.value;
            const normalized = normalizePhoneValue(value);

            if (normalized.startsWith('+')) {
                phoneInput.value = normalized.slice(0, 12);
            } else {
                phoneInput.value = normalized.slice(0, 11);
            }

            try { phoneInput.setSelectionRange(pos, pos); } catch (err) {}
            phoneInput.classList.remove('border-red-500');
            phoneError.classList.add('hidden');
        });

        phoneInput.addEventListener('blur', () => {
            const val = normalizePhoneValue(phoneInput.value);
            phoneInput.value = val;
            if (!E164_REGEX.test(val)) {
                phoneInput.classList.add('border-red-500');
                phoneError.classList.remove('hidden');
            } else {
                phoneInput.classList.remove('border-red-500');
                phoneError.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
