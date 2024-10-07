<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <form action="{{ route('orders.update',['order' => $order]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card mb-4 p-3 pt-0">
                        <h2 class="text-center">
                            <a class="purchase-title" href="{{ route('orders.index') }}">
                                <img src="/arrow-back.svg" alt="">
                            </a>
                            Edit order</h2>
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach($order->photos as $photo)
                                    <div class="swiper-slide" id="slide-{{$photo->id}}">
                                        <a href="image4_large.jpg" data-lightbox="gallery">
                                            <img src="{{ $photo->path }}" alt="Image 4">
                                        </a>
                                        <button type="button" class="delete-button btn btn-sm btn-danger" onclick="confirmDelete({{ $photo->id }})">Удалить</button>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Навигация -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <!-- Ползунок -->
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="mb-3 text-center">
                            <code class="text-dark">
                                Please limit adding 1 vehicle per order. If you would like to add more than 1 vehicle,
                                create
                                separate orders to avoid delays.
                            </code>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="order_id" class="form-label">Order ID</label>
                                        <input type="text" class="form-control" name="order_id" value="{{ $order->order_id }}"
                                               :value="{{ old('order_id') }}">
                                        <x-input-error :messages="$errors->get('order_id')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-8 col-sm-12">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Client</label>
                                        <select name="user_id" class="form-control" required>
                                            {{!!\App\Helpers\Helper::getOptions($users, $order->user_id)!!}}
                                        </select>
                                        <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="make" class="form-label">Desired Make</label>
                                        <select name="make" class="form-control" required>
                                            {{!!\App\Helpers\Helper::getOptions($makes, $order->make)!!}}
                                        </select>
                                        <x-input-error :messages="$errors->get('make')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="model" class="form-label">Desired Model</label>
                                        <input type="text" class="form-control" name="model" value="{{ $order->model }}"
                                               :value="{{ old('model') }}">
                                        <x-input-error :messages="$errors->get('model')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="years" class="form-label">Desired Year Range</label>
                                        <input type="number" class="form-control" name="years" value="{{ $order->years }}"
                                               :value="{{ old('years') }}">
                                        <x-input-error :messages="$errors->get('years')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="colors" class="form-label">Desired Colors</label>
                                        <input type="text" class="form-control" name="colors" value="{{ $order->colors }}"
                                               :value="{{ old('colors') }}">
                                        <x-input-error :messages="$errors->get('colors')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="max_miles" class="form-label">Desired Max Miles</label>
                                <input type="number" class="form-control" name="max_miles" value="{{ $order->max_miles }}"
                                       :value="{{ old('max_miles') }}">
                                <x-input-error :messages="$errors->get('max_miles')" class="mt-2"/>
                            </div>
                            <div class="mb-3">
                                <label for="max_bid" class="form-label">Desired Max Bid</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button disabled class="btn btn-outline-secondary form-control" type="button">USD</button>
                                    </div>
                                    <input type="number" class="form-control" name="max_bid" value="{{ $order->max_bid }}" :value="{{ old('max_bid') }}">
                                    <x-input-error :messages="$errors->get('max_bid')" class="mt-2"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="damage_level" class="form-label">Damage Level</label>
                                        <select name="damage_level" class="form-control" required>
                                            {{!!\App\Helpers\Helper::getOptions($damageLevels, $order->damage_level)!!}}
                                        </select>
                                        <x-input-error :messages="$errors->get('damage_level')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="state" class="form-label">Order state</label>
                                        <select name="state" class="form-control" required>
                                            {{!!\App\Helpers\Helper::getOptions($orderStates, $order->state)!!}}
                                        </select>
                                        <x-input-error :messages="$errors->get('state')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="max_bid" class="form-label">Notes</label>
                                <textarea name="notes" class="form-control" cols="15"
                                          rows="3">{{ old('notes') }} {{ $order->notes }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2"/>
                            </div>
                            <div class="mb-3">
                                <label for="max_bid" class="form-label d-block mb-2">Upload sample photo</label>
                                <input type="file" name="photo[]" multiple>
                                <x-input-error :messages="$errors->get('photo')" class="mt-2"/>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-md-4">
                                <button class="btn btn-primary float-end">Save</button>
                                <button class="btn btn-primary float-end" style="margin-right: 10px" name="createPurchase" value="1">Save and create purchase</button>
                                <a href="{{ route("orders.index") }}" class="btn btn-secondary float-end d-block" style="margin-right: 10px">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
<style>
    /* Основные стили для карусели */
    .swiper {
        width: 100%;
        height: 400px; /* Высота карусели */
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        max-width: 100%;
        max-height: 100%;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .swiper-slide img:hover {
        transform: scale(1.05);
    }
    .delete-button {
        cursor: pointer;
        bottom: 20px;
        right: 20px;
        position: absolute;
    }
</style>
<script>
    new Swiper('.swiper', {
        // Опции Swiper
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    document.querySelectorAll('.swiper-slide').forEach(slide => {
        slide.addEventListener('click', (event) => {
            event.preventDefault(); // Предотвращаем переход по ссылке
            const link = slide.querySelector('a');
            if (link) {
                lightbox.start(link); // Запускаем Lightbox с соответствующей ссылкой
            }
        });
    });

    function confirmDelete(photoId) {
        if (confirm('Do you want delete this photo?')) {
            $.ajax({
                url: '/photos/' + photoId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('#slide-' + photoId).hide(); // Удаляем слайд из DOM
                    alert('Photo deleted');
                    // Обновляем Swiper после удаления
                    swiper.update();
                },
                error: function(xhr) {
                    alert('Photo deleting error');
                }
            });
        }
    }
</script>
