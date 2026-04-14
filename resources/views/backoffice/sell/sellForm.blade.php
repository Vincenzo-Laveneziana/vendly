@extends('frontoffice.master')

@section('title', 'Form di Vendita')

@section('content')
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">
                <form action="{{ route('Backoffice.createProduct') }}" method="POST" enctype="multipart/form-data"
                    id="postForm" class="p-8 md:p-12">
                    @csrf
                    <input id="images" name="images[]" type="file" class="hidden" accept="image/jpeg,image/png,image/webp"
                        multiple>

                    <div class="grid md:grid-cols-2 gap-12 items-start">
                        <!-- Colonna di sx -->
                        <div class="space-y-4">
                            <label
                                class="block text-sm font-semibold text-gray-700">{{ __('Immagini del prodotto') }}</label>

                            <label for="images"
                                class="relative cursor-pointer flex flex-col items-center justify-center aspect-[4/3] w-full border-2 border-dashed border-gray-200 rounded-3xl hover:border-[#08B2B4] hover:bg-[#08B2B4]/5 transition-all group">
                                <div class="flex flex-col items-center justify-center text-center px-4">
                                    <span
                                        class="material-symbols-outlined text-gray-300 text-5xl group-hover:text-[#08B2B4] transition-colors mb-2">add</span>
                                    <p
                                        class="text-gray-400 font-medium text-sm group-hover:text-[#08B2B4] transition-colors">
                                        {{ __('Aggiungi una o più immagini') }}
                                    </p>
                                </div>
                            </label>

                            <div id="preview-container" class="grid grid-cols-3 gap-3">
                                <!-- Anteprime Immagini -->
                            </div>
                        </div>

                        <!-- Colonna di dx -->
                        <div class="space-y-6">
                            <!-- Titolo -->
                            <div>
                                <div class="flex justify-between items-end mb-1.5">
                                    <label for="title"
                                        class="text-sm font-semibold text-gray-700">{{ __('Titolo') }}</label>
                                    <span id="title-char-count" class="text-[11px] text-gray-400">0 / 30</span>
                                </div>
                                <div class="vue-island">
                                    <ui-input name="title" id="title" maxlength="30" placeholder="Es: Pc Asus"
                                        class="h-12 rounded-xl bg-gray-50/50 border-gray-200 focus:border-[#08B2B4] focus:ring-2 focus:ring-[#08B2B4]/10"
                                        required>{{ old('title') }}</ui-input>
                                </div>
                            </div>

                            <!-- Descrizione -->
                            <div>
                                <div class="flex justify-between items-end mb-1.5">
                                    <label for="description"
                                        class="text-sm font-semibold text-gray-700">{{ __('Descrizione') }}</label>
                                    <span id="desc-char-count" class="text-[11px] text-gray-400">0 / 1000</span>
                                </div>
                                <textarea name="description" id="description" maxlength="1000"
                                    placeholder="{{ __('Inserisci la descrizione del prodotto..') }}" rows="4"
                                    class="w-full p-4 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#08B2B4]/10 focus:border-[#08B2B4] transition-all resize-none">{{ old('description') }}</textarea>
                            </div>

                            <!-- Categoria -->
                            <div>
                                <label for="category"
                                    class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('Categoria') }}</label>
                                <div class="relative">
                                    <select name="category" id="category"
                                        class="w-full h-12 px-4 pr-10 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#08B2B4]/10 focus:border-[#08B2B4] transition-all appearance-none cursor-pointer">
                                        <option value="" selected>{{ __('Scegli una categoria') }}</option>
                                        @foreach($categories as $id => $name)
                                            <option value="{{ $id }}">{{ $name[app()->getLocale()] ?? $name['it'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="material-symbols-outlined text-gray-400 text-xl">expand_more</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Prezzo -->
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-700 mb-1.5">{{
        __('Prezzo') }}</label>
                                <div class="vue-island">
                                    <div class="relative">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 z-10">
                                            <span class="text-gray-400 font-medium text-sm">€</span>
                                        </div>
                                        <ui-input type="number" name="price" id="price" placeholder="0,00" step="0.01"
                                            min="0"
                                            class="h-12 pl-9 rounded-xl bg-gray-50/50 border-gray-200 focus:border-[#08B2B4] focus:ring-2 focus:ring-[#08B2B4]/10 transition-all font-medium"
                                            required>{{ old('price') }}</ui-input>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress bar -->
                            <div id="upload-progress-container" class="hidden space-y-2 pt-2">
                                <div class="flex justify-between text-[11px] font-bold text-[#08B2B4]">
                                    <span>{{ __('Caricamento in corso...') }}</span>
                                    <span id="upload-percentage">0%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                    <div id="upload-progress-bar" class="bg-[#08B2B4] h-full transition-all duration-200"
                                        style="width: 0%"></div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="flex justify-end pt-4">
                                <div class="vue-island">
                                    <ui-button type="submit" id="submitBtn"
                                        class="h-12 px-10 bg-[#08B2B4] hover:bg-[#069a9c] text-white font-bold rounded-xl transition-all active:scale-95 shadow-lg">
                                        {{ __('Salva') }}
                                    </ui-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let filesArray = [];
        let pendingReads = 0;
        const imagesInput = document.getElementById('images');
        const container = document.getElementById('preview-container');
        const postForm = document.getElementById('postForm');

        // --- PREVIEW IMMAGINI ---
        imagesInput.addEventListener('change', function (e) {
            const newFiles = Array.from(e.target.files);

            newFiles.forEach(file => {
                pendingReads++;

                const div = document.createElement('div');
                div.className = "relative group aspect-square animate-fade-in";
                div.innerHTML = `
                                                                                            <div class="loading-placeholder h-full w-full rounded-2xl border border-gray-100 bg-gray-50 flex items-center justify-center">
                                                                                                <svg class="animate-spin h-6 w-6 text-[#08B2B4]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                                                                                </svg>
                                                                                            </div>
                                                                                        `;
                container.appendChild(div);

                compressImage(file).then(compressedFile => {
                    filesArray.push(compressedFile);

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        div.innerHTML = `
                                                                                            <div class="relative h-full w-full rounded-2xl overflow-hidden border border-gray-100 shadow-sm group">
                                                                                                <img src="${event.target.result}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                                                                                                <div class="cover-badge hidden absolute top-1.5 left-1.5 bg-[#08B2B4] text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm">
                                                                                                    Copertina
                                                                                                </div>
                                                                                                <button type="button" class="remove-img-btn absolute top-1.5 right-1.5 bg-white/90 text-gray-600 rounded-full h-6 w-6 flex items-center justify-center shadow-sm hover:bg-red-500 hover:text-white transition-all opacity-0 group-hover:opacity-100">
                                                                                                    <span class="material-symbols-outlined text-[14px]">close</span>
                                                                                                </button>
                                                                                            </div>
                                                                                        `;

                        div.querySelector('.remove-img-btn').onclick = function () {
                            filesArray = filesArray.filter(f => f !== compressedFile);
                            div.remove();
                            updateInputFiles();
                            updateCoverBadge();
                        };

                        pendingReads--;
                        updateInputFiles();
                        updateCoverBadge();
                    };

                    reader.onerror = function () {
                        div.remove();
                        filesArray = filesArray.filter(f => f !== compressedFile);
                        pendingReads--;
                    };

                    reader.readAsDataURL(compressedFile);
                });
            });
        });

        function updateCoverBadge() {
            const previews = container.querySelectorAll('.cover-badge');
            previews.forEach((badge, index) => {
                if (index === 0) {
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            });
        }

        function compressImage(file, maxSizeMB = 1.8) {
            return new Promise((resolve) => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                const img = new Image();

                img.onload = function () {
                    let width = img.width;
                    let height = img.height;
                    const maxDim = 1920;

                    if (width > maxDim || height > maxDim) {
                        if (width > height) {
                            height = Math.round((height / width) * maxDim);
                            width = maxDim;
                        } else {
                            width = Math.round((width / height) * maxDim);
                            height = maxDim;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);

                    let quality = 0.85;
                    const compress = () => {
                        canvas.toBlob((blob) => {
                            if (blob.size > maxSizeMB * 1024 * 1024 && quality > 0.1) {
                                quality -= 0.1;
                                compress();
                            } else {
                                const compressedFile = new File([blob], file.name, {
                                    type: 'image/jpeg',
                                    lastModified: Date.now()
                                });
                                resolve(compressedFile);
                            }
                        }, 'image/jpeg', quality);
                    };
                    compress();
                };

                img.src = URL.createObjectURL(file);
            });
        }

        function updateInputFiles() {
            const dataTransfer = new DataTransfer();
            filesArray.forEach(file => dataTransfer.items.add(file));
            imagesInput.files = dataTransfer.files;
        }

        // --- COUNTER CARATTERI ---
        // Il title è dentro un vue-island, quindi aspettiamo che Vue monti
        function initCharCounters() {
            const titleEl = document.getElementById('title');
            const descEl = document.getElementById('description');
            const titleCount = document.getElementById('title-char-count');
            const descCount = document.getElementById('desc-char-count');

            if (titleEl && titleEl.tagName === 'INPUT') {
                titleEl.addEventListener('input', () => {
                    titleCount.textContent = `${titleEl.value.length} / 30`;
                    titleCount.className = titleEl.value.length >= 30 ? "text-[11px] text-red-500 font-bold" : "text-[11px] text-gray-400";
                });
            } else {
                // Vue non ha ancora montato, riprova
                setTimeout(initCharCounters, 200);
                return;
            }

            if (descEl) {
                descEl.addEventListener('input', () => {
                    descCount.textContent = `${descEl.value.length} / 1000`;
                    descCount.className = descEl.value.length >= 1000 ? "text-[11px] text-red-500 font-bold" : "text-[11px] text-gray-400";
                });
            }
        }

        // Avvia dopo un breve delay per dare tempo a Vue di montare gli island
        setTimeout(initCharCounters, 300);

        // --- LOGICA DI INVIO ---
        postForm.onsubmit = function (e) {
            e.preventDefault();

            if (pendingReads > 0) {
                alert("Attendi il caricamento delle immagini prima del salvataggio.");
                return;
            }

            const formData = new FormData(postForm);
            const xhr = new XMLHttpRequest();

            const progressContainer = document.getElementById('upload-progress-container');
            const progressBar = document.getElementById('upload-progress-bar');
            const progressText = document.getElementById('upload-percentage');
            const submitBtn = document.getElementById('submitBtn');

            progressContainer.classList.remove('hidden');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50');
            }

            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + '%';
                    progressText.textContent = percent + '%';
                }
            });

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 400) {
                    window.location.href = "{{ route('Frontoffice.explore') }}";
                } else {
                    alert("Errore nel caricamento. Riprova.");
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50');
                    }
                    progressContainer.classList.add('hidden');
                }
            };

            xhr.open('POST', postForm.action, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(formData);
        };
    </script>
@endsection