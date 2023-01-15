<div>
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
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ Session::get('msgExcError') }}
                    </div>
                </div>
            @endif
            @if (Session::has('msgAddToDb'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong>Updated!</strong> {{ Session::get('msgAddToDb') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::has('activeInactiveFlag'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong>Status Update!</strong> {{ Session::get('activeInactiveFlag') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped zero-configuration">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Phone</th>
                            <th>Gander</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ !empty($user->no_phone) ? $user->no_phone : '-' }}</td>
                                <td>{{ empty($user->gander) ? '-' : ($user->gander == '1' ? 'Laki-laki' : 'Perempuan') }}
                                </td>
                                <td style="font-weight: {{ $user->user_type == 'ADM' ? 'bold' : '' }}">
                                    {{ $user->user_type == 'ADM' ? 'Admin' : 'User' }}</td>
                                <td>
                                    <a href="" wire:click.prevent="ActiveInactiveUserModel({{ $user->id }})"
                                        data-bs-toggle="modal" data-bs-target="#modalActiveInactiveUser">
                                        <span
                                            class="badge rounded-pill bg-{{ $user->flag_active == null ? 'danger' : ($user->flag_active == 'N' ? 'warning' : 'success') }}">
                                            {{ $user->flag_active == null ? 'NEW' : ($user->flag_active == 'N' ? 'Inactive' : 'Active') }}
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="pr-2" wire:click.prevent="updateDataUserModel({{ $user->id }})"
                                        data-bs-toggle="modal" data-bs-target="#modalEditUser"><i class='bx bxs-edit'
                                            style="color: rgb(255, 170, 0)"></i></a>
                                    <a href="javascript:void(0)"
                                        wire:click.prevent="modelDelteUser({{ $user->id }})" data-bs-toggle="modal"
                                        data-bs-target="#modalDeleteUser"><i class='bx bx-trash'
                                            style="color: red"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="8">Data Tidak Ditemukan!</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Phone</th>
                            <th>Gander</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit User</h5>
                    <button wire:click="resetFromAdd()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='updateDataUser()' enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-home"
                                        aria-controls="navs-pills-justified-home" aria-selected="true">
                                        <i class="tf-icons bx bx-user"></i> Profile
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-profile"
                                        aria-controls="navs-pills-justified-profile" aria-selected="false">
                                        <i class="tf-icons bx bx-info-circle"></i> Info User
                                    </button>
                                </li>
                                {{-- <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-messages"
                                        aria-controls="navs-pills-justified-messages" aria-selected="false">
                                        <i class="tf-icons bx bx-message-square"></i> Messages
                                    </button>
                                </li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                                    <div class="row g-2">
                                        <div class="col-md-6 mb-1">
                                            <label>Header 1:</label>
                                            <input wire:model="" type="text" class="form-control"
                                                placeholder="Enter Header 1" />
                                            <div>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label>Header 2:</label>
                                            <input wire:model="" type="text" class="form-control"
                                                placeholder="Enter Header 2" />
                                            <div>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <label>Button Text:</label>
                                            <input wire:model="" type="text" class="form-control"
                                                placeholder="Enter BTN Text" />
                                            <div>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <label>Button URL:</label>
                                            <input wire:model="" type="text" class="form-control"
                                                placeholder="https://example-url" />
                                            <div>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                                    <div class="row g-2">
                                        <div class="col-md-6 mb-1">
                                            <label>Header 1:</label>
                                            <input wire:model="" type="text" class="form-control"
                                                placeholder="Enter Header 1" />
                                            <div>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label>Header 2:</label>
                                            <input wire:model="" type="text" class="form-control"
                                                placeholder="Enter Header 2" />
                                            <div>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <label>Button Text:</label>
                                            <input wire:model="" type="text" class="form-control"
                                                placeholder="Enter BTN Text" />
                                            <div>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <label>Button URL:</label>
                                            <input wire:model="" type="text" class="form-control"
                                                placeholder="https://example-url" />
                                            <div>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                                </div> --}}
                            </div>
                        </div>
                    </div>  
                </form>
                <div class="modal-footer">
                    <button wire:click="resetFromAdd()" type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalDeleteUser" tabindex="-1" aria-hidden="true"
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
                    <strong>"{{ $name }}"</strong>
                </div>
                <div class="modal-footer justify-content-center">
                    <button wire:click="resetFromAdd()" type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <button wire:click.prevent="deleteDataUserFromDb({{ $id_user }})" type="submit"
                        class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalActiveInactiveUser" tabindex="-1" aria-hidden="true"
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
                        </span> user
                    </span><br>
                    <strong>"{{ $name }}"</strong>
                </div>
                <div class="modal-footer justify-content-center">
                    @if (empty($flag_active))
                        <button wire:click.prevent="activeInactiveUser({{ $id_user }}, 'Y')" type="submit"
                            class="btn btn-warning">
                            Inactive
                        </button>
                    @endif
                    <button wire:click.prevent="activeInactiveUser({{ $id_user }}, '{{ $flag_active }}')"
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
        $('#modalDeleteUser').modal('hide');
        $('#modalActiveInactiveUser').modal('hide');
    });
</script>
