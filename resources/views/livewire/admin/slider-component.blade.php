<div>
    <style>
        .alertMsg {
            position: fixed;
            margin-top: 20px;
            margin-right: 20px;
            width: 350px;
            top: 0;
            right: 0;
        }

        .pickgradient {
            background: rgb(0, 0, 0);
            background: linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgba(34, 193, 195, 0) 40%);
        }

        .pickgradient img {
            position: relative;
            z-index: -1;
            display: block;
            width: auto;
        }
    </style>

    <div class="row">
        <!-- Bootstrap crossfade carousel -->
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade"
                        data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            @if (!$slidersz->isEmpty())
                                @for ($i = 0; $i < count($slidersz); $i++)
                                    <li data-bs-target="#carouselExample-cf" data-bs-slide-to="{{ $i }}"
                                        class="{{ $i == 0 ? 'active' : '' }}"></li>
                                @endfor
                            @endif
                        </ol>
                        <div class="carousel-inner">
                            @if (!$slidersz->isEmpty())
                                @for ($i = 0; $i < count($slidersz); $i++)
                                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                        <div class="pickgradient">
                                            <img class="d-block w-100" src="{{ asset('assetc/images/slider-bg.jpg') }}"
                                                style="object-fit: cover;" height="450" alt="First slide" />
                                        </div>
                                        <div class="carousel-caption d-none d-md-block">
                                            <span
                                                class="badge rounded-pill bg-{{ $slidersz[$i]->flag_active == null ? 'danger' : ($slidersz[$i]->flag_active == 'N' ? 'warning' : 'success') }}">
                                                {{ $slidersz[$i]->flag_active == null ? 'NEW' : ($slidersz[$i]->flag_active == 'N' ? 'Inactive' : 'Active') }}
                                            </span>
                                            <h2 class="text-white mb-0 mt-3">{{ $slidersz[$i]->heading1 }} {{ $slidersz[$i]->heading2 }}</h2>
                                            <span class="text-white">{{ $slidersz[$i]->description }}</span>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample-cf" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row container-p-y">
        <div class="col-md">
            <div class="card">
                <div class="card-body pb-0 d-flex justify-content-between">
                    <div>
                        <h4>Home Slider</h4>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalAddToDb">New Slider</button>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('msgExcError'))
                        <div class="bs-toast toast fade show bg-warning alertMsg" role="alert" aria-live="assertive"
                            aria-atomic="true">
                            <div class="toast-header">
                                <i class="bx bx-bell me-2"></i>
                                <div class="me-auto fw-semibold">System!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                {{ Session::get('msgExcError') }}
                            </div>
                        </div>
                    @endif
                    @if (Session::has('msgAddToDb'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>Slider!</strong> {{ Session::get('msgAddToDb') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('activeInactiveFlag'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>Status Update!</strong> {{ Session::get('activeInactiveFlag') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped zero-configuration">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th width="550px">Description</th>
                                    <th>Button</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sliders as $slide)
                                    <tr>
                                        <td>{{ $slide->id }}</td>
                                        <td>{{ $slide->heading1 . ' ' . $slide->heading2 }}</td>
                                        <td wid>{{ $slide->description }}</td>
                                        <td>{{ $slide->btn_text }}</td>
                                        <td>{{ $slide->btn_url }}</td>
                                        <td>
                                            <a href=""
                                                wire:click.prevent="ActiveInactiveSliderModel({{ $slide->id }})"
                                                data-bs-toggle="modal" data-bs-target="#modalActiveInactiveSlider">
                                                <span
                                                    class="badge rounded-pill bg-{{ $slide->flag_active == null ? 'danger' : ($slide->flag_active == 'N' ? 'warning' : 'success') }}">
                                                    {{ $slide->flag_active == null ? 'NEW' : ($slide->flag_active == 'N' ? 'Inactive' : 'Active') }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="pr-2"
                                                wire:click.prevent="EditDataSliderModel({{ $slide->id }})"
                                                data-bs-toggle="modal" data-bs-target="#modalEditSlider"><i
                                                    class='bx bxs-edit' style="color: rgb(255, 170, 0)"></i></a>
                                            <a href="javascript:void(0)"
                                                wire:click.prevent="modalDeleteSlider({{ $slide->id }})"
                                                data-bs-toggle="modal" data-bs-target="#modalDeleteSlider"><i
                                                    class='bx bx-trash' style="color: red"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Data tidak ditemukan!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Button</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div>
                            {{ $sliders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modalAddToDb" tabindex="-1" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">New Carousel</h5>
                    <button wire:click="resetFromAdd()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='addSliderToDb()' enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-6 mb-1">
                                <label>Header 1:</label>
                                <input wire:model="heading1" type="text" class="form-control"
                                    placeholder="Enter Header 1" />
                                <div>
                                    @error('heading1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label>Header 2:</label>
                                <input wire:model="heading2" type="text" class="form-control"
                                    placeholder="Enter Header 2" />
                                <div>
                                    @error('heading2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-0">
                                <label>Button Text:</label>
                                <input wire:model="btn_text" type="text" class="form-control"
                                    placeholder="Enter BTN Text" />
                                <div>
                                    @error('btn_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-0">
                                <label>Button URL:</label>
                                <input wire:model="btn_url" type="text" class="form-control"
                                    placeholder="https://example-url" />
                                <div>
                                    @error('btn_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label>Description:</label>
                                <textarea wire:model="description" class="form-control" name="desc_carousel" id="desc_carousel" rows="4"
                                    placeholder="Enter Description Carousel"></textarea>
                            </div>
                            <div>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetFromAdd()" type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalEditSlider" tabindex="-1" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Carousel</h5>
                    <button wire:click="resetFromAdd()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='updateDataSlider({{ $slider_id }})' enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-6 mb-1">
                                <label>Header 1:</label>
                                <input wire:model="heading1" type="text" class="form-control"
                                    placeholder="Enter Header 1" />
                                <div>
                                    @error('heading1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label>Header 2:</label>
                                <input wire:model="heading2" type="text" class="form-control"
                                    placeholder="Enter Header 2" />
                                <div>
                                    @error('heading2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-0">
                                <label>Button Text:</label>
                                <input wire:model="btn_text" type="text" class="form-control"
                                    placeholder="Enter BTN Text" />
                                <div>
                                    @error('btn_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-0">
                                <label>Button URL:</label>
                                <input wire:model="btn_url" type="text" class="form-control"
                                    placeholder="https://example-url" />
                                <div>
                                    @error('btn_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label>Description:</label>
                                <textarea wire:model="description" class="form-control" name="desc_carousel" id="desc_carousel" rows="4"
                                    placeholder="Enter Description Carousel"></textarea>
                            </div>
                            <div>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetFromAdd()" type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalDeleteSlider" tabindex="-1" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button wire:click="resetFromAdd()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4>Konfirmasi hapus data?</h4>
                    <span>Apakah yakin ingin menghapus carousel</span><br>
                    <strong>"{{ $heading1 . ' ' . $heading2 }}"</strong>
                </div>
                <div class="modal-footer justify-content-center">
                    <button wire:click="resetFromAdd()" type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <button wire:click.prevent="deleteDataSlider({{ $slider_id }})" type="submit"
                        class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalActiveInactiveSlider" tabindex="-1" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button wire:click="resetFromAdd()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4>Konfirmasi update data?</h4>
                    <span>
                        Apakah yakin ingin meng-
                        <span
                            class="text-{{ strtolower($flag_active) == 'y' ? 'warning' : (strtolower($flag_active) == 'n' ? 'success' : 'success') }}">
                            {{ strtolower($flag_active) == 'y' ? 'Nonatifkan' : (strtolower($flag_active) == 'n' ? 'Aktifkan' : 'Aktifkan') }}
                        </span> Slider
                    </span><br>
                    <strong>"{{ $heading1 . ' ' . $heading2 }}"</strong>
                </div>
                <div class="modal-footer justify-content-center">
                    @if (empty($flag_active))
                        <button wire:click.prevent="activeInactiveSlider({{ $slider_id }}, 'Y')" type="button"
                            class="btn btn-warning" data-bs-dismiss="modal">
                            inactive
                        </button>
                    @endif
                    <button wire:click.prevent="activeInactiveSlider({{ $slider_id }}, '{{ $flag_active }}')"
                        type="submit"
                        class="btn btn-{{ strtolower($flag_active) == 'y' ? 'warning' : (strtolower($flag_active) == 'n' ? 'success' : 'success') }}">
                        {{ strtolower($flag_active) == 'y' ? 'Inactive' : (strtolower($flag_active) == 'n' ? 'Active' : 'Active') }}
                    </button>
                    <button wire:click="resetFromAdd()" type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('close-form-modal', event => {
        $('#modalAddToDb').modal('hide');
        $('#modalEditSlider').modal('hide');
        $('#modalDeleteSlider').modal('hide');
        $('#modalActiveInactiveSlider').modal('hide');
    });
</script>
