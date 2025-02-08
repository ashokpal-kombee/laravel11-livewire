<div class="col-md-8">
    <div class="card">
        <div class="card-header">Edit Blog</div>
        <div class="card-body">
            <form wire:submit="update">
                <div class="mb-3 row">
                    <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            wire:model="title" >
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="title" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                    <div class="col-md-6">
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                            wire:model="description"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="photo" class="col-md-4 col-form-label text-md-end text-start">Photo</label>
                    <div class="col-md-6">
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="title"
                            wire:model="photo">
                        @if ($errors->has('photo'))
                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-6">
                    <img src="{{ url('storage/' . $photo) }}" alt="Blog Photo" height="60" width="60">
                </div>
                </div>
                <div class="mb-3 row">
                    <button type="submit" class="col-md-3 offset-md-5 btn btn-primary">Update</button>
                    <button wire:click.prevent="cancel()" class="col-md-3 offset-md-5 btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
