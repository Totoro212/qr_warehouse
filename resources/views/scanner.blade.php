<x-app-layout>
    <x-slot name="header">
        <x-page-header title="QR-сканер" description="Поиск товара по QR-коду" />
    </x-slot>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <x-card class="overflow-hidden h-full">
                <div class="p-6 h-full">
                    <div id="scanner-container" class="relative bg-slate-900 rounded-xl overflow-hidden"
                        style="min-height: 480px;">
                        <video id="video" class="w-full h-full object-cover absolute inset-0" autoplay
                            playsinline></video>
                        <canvas id="canvas" class="hidden"></canvas>

                        <div id="status-starting"
                            class="absolute inset-0 flex items-center justify-center bg-slate-900/80">
                            <div class="text-center text-white">
                                <svg class="w-12 h-12 mx-auto mb-4 animate-spin" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <x-text-body class="font-medium">Запуск камеры...</x-text-body>
                            </div>
                        </div>

                        <div id="status-error"
                            class="absolute inset-0 flex items-center justify-center bg-slate-900/80 hidden">
                            <div class="text-center text-white p-6">
                                <svg class="w-12 h-12 mx-auto mb-4 text-red-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <x-text-body class="font-medium mb-2">Нет доступа к камере</x-text-body>
                                <x-text-small>Разрешите доступ к камере в браузере</x-text-small>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="lg:col-span-1 flex flex-col gap-6">
            <x-card class="overflow-hidden">
                <div class="p-6">
                    <x-primary-button type="button" id="btn-scan" onclick="startScanning()"
                        class="w-full gap-2 py-4 text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        <span id="btn-text">Начать сканирование</span>
                    </x-primary-button>
                </div>
            </x-card>

            <x-card id="result-area" class="overflow-hidden hidden">
                <div class="p-6">
                    <div id="result-error" class="hidden text-center py-4">
                        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <x-text-body class="font-medium mb-1">Товар не найден</x-text-body>
                        <x-text-small id="result-error-msg"></x-text-small>
                    </div>
                </div>
            </x-card>

            <x-card class="p-6">
                <x-heading-4 class="mb-3">Как использовать</x-heading-4>
                <ol class="list-decimal list-inside space-y-2">
                    <li>Нажмите "Начать сканирование"</li>
                    <li>Разрешите доступ к камере</li>
                    <li>Наведите камеру на QR-код товара</li>
                    <li>Система автоматически распознает код</li>
                </ol>
            </x-card>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>

    <script>
        let video = document.getElementById('video');
        let canvas = document.getElementById('canvas');
        let ctx = canvas.getContext('2d');
        let scanning = false;
        let lastScannedCode = null;

        async function startScanning() {
            const statusStarting = document.getElementById('status-starting');
            const statusError = document.getElementById('status-error');
            const resultArea = document.getElementById('result-area');
            const btnText = document.getElementById('btn-text');


            resultArea.classList.add('hidden');
            document.getElementById('result-error').classList.add('hidden');
            statusStarting.classList.remove('hidden');
            statusError.classList.add('hidden');
            lastScannedCode = null;

            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'environment', width: { ideal: 1280 }, height: { ideal: 720 } }
                });

                video.srcObject = stream;
                await video.play();

                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                statusStarting.classList.add('hidden');
                btnText.textContent = 'Сканирование...';
                scanning = true;

                requestAnimationFrame(scanFrame);
            } catch (err) {
                console.error('Camera error:', err);
                statusStarting.classList.add('hidden');
                statusError.classList.remove('hidden');
                btnText.textContent = 'Начать сканирование';
            }
        }

        function scanFrame() {
            if (!scanning) return;

            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: 'dontInvert'
                });

                if (code && code.data && code.data !== lastScannedCode) {
                    lastScannedCode = code.data;
                    handleQRCode(code.data);
                }
            }

            requestAnimationFrame(scanFrame);
        }

        async function handleQRCode(data) {
            const resultArea = document.getElementById('result-area');
            const resultError = document.getElementById('result-error');

            let productId = null;

            const productUrlMatch = data.match(/\/products\/(\d+)/);
            if (productUrlMatch) {
                productId = productUrlMatch[1];
            }

            if (productId) {
                window.location.href = `/products/${productId}`;
                return;
            }

            resultArea.classList.remove('hidden');
            document.getElementById('result-error-msg').textContent = 'QR-код не принадлежит товару склада';
            resultError.classList.remove('hidden');
        }

        function stopScanning() {
            scanning = false;
            if (video.srcObject) {
                video.srcObject.getTracks().forEach(track => track.stop());
            }
            document.getElementById('btn-text').textContent = 'Начать сканирование';
        }


        window.addEventListener('beforeunload', stopScanning);
    </script>


</x-app-layout>