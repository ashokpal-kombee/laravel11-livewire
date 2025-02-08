<div class="row justify-content-center">
    

    @if ($updateMode)
        @include('livewire.blog.update')
    @else
        @include('livewire.blog.create')
    @endif
    <div class="col-md-8 m-3">
        <div class="card">
            <div class="card-header">Blog List
                <!--<button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#userModal">
                    <i class="fa fa-plus"></i> Add New Blog
                </button>-->
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bloges as $bloge)
                            <tr>
                                <td>{{ $bloge->id }}</td>
                                <td>
                                    <img src="{{ url('storage/' . $bloge->photo) }}" alt="Blog Photo" height="60" width="60">
                                </td>
                                <td>{{ $bloge->title }}</td>
                                <td>{{ $bloge->description }}</td>
                                <td>
                                    <button wire:click="edit({{ $bloge->id }})"
                                        class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $bloge->id }})"
                                        wire:confirm="Are you sure you want to delete this Blog ?"  class="btn btn-danger btn-sm">Delete</button>
                                        <button type="button" wire:click="download({{ $bloge->id }})">Download</button> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
