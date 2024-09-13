<div>
    @push('breadcrumbs')
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Users</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Users</h6>
    @endpush
    <livewire:toaster/>
    <div class="card mt-5">
        <div class="card-body">
            <div class="card-title mb-4 d-flex flex-row">
                <h3>Users</h3>
                <x-a-button class="btn btn-success ms-3">
                    <x-slot name="others">
                        data-bs-toggle="modal" data-bs-target="#userModal" wire:click="$set('details', [])"
                    </x-slot>
                    <i class="fas fa-plus"></i> Add User
                </x-a-button>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row mb-4 mx-2">
                    </div>
                </div>
                <div class="col-12">
                    <livewire:user-table/>
                </div>
            </div>
        </div>
    </div>
    {{--Add--}}
    <x-modalform id="userModal" modalTitle="New User" size="modal-lg">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Agency</label>
                <x-select model="details.agency_id">
                    @foreach($agencies as $agency)
                        <option value="{{ $agency['id'] }}">{{ $agency['name'] }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Roles</label>
                <x-select model="details.role">
                    <option value="1">Admin</option>
                    <option value="2">Agency</option>
                    <option value="4">Gov</option>
                </x-select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Name</label>
                <x-input model="details.name"/>
            </div>
            <div class="col-md-4 mb-3">
                <label>E-mail</label>
                <x-input model="details.email"/>
            </div>
            <div class="col-md-4 mb-3">
                <label>Password</label>
                <x-input type="password" model="details.password"/>
            </div>
            <div class="col-md-4 mb-3">
                <label>Confirm Password</label>
                <x-input type="password" model="details.password_confirmation"/>
            </div>
            <div class="col-md-12">
                <x-errors/>
            </div>
        </div>
        <x-slot name="button">
            <button type="button" class="btn btn-primary" wire:click="store">Save changes</button>
        </x-slot>
    </x-modalform>
    {{--Edit --}}
    <x-modalform id="userEditModal" size="modal-lg" modalTitle="Edit User">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Agency</label>
                <x-select model="details.agency_id">
                    @foreach($agencies as $agency)
                        <option value="{{ $agency['id'] }}">{{ $agency['name'] }}</option>
                    @endforeach
                </x-select>
                @error('details.agency_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label>Roles</label>
                <x-select model="details.role">
                    <option value="1">Admin</option>
                    <option value="2">Agency</option>
                    <option value="4">Gov</option>
                </x-select>
                @error('details.role') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label>Name</label>
                <x-input model="details.name"/>
                @error('details.name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label>E-mail</label>
                <x-input model="details.email"/>
                @error('details.email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <x-slot name="button">
            <button type="button" class="btn btn-info" wire:click="edit">Update</button>
            <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
        </x-slot>
    </x-modalform>
</div>
