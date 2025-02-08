<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Computed </div>
            <div class="card-body">
                <p>Welcome to {{ $this->getFullNameProperty() }}.</p>


                <div wire:offline>
                     You are currently offline.
                </div>
            </div>
        </div>
    </div>    
</div>