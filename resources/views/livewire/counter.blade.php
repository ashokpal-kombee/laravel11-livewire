<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Counter</div>
                <div class="card-body">
                    <h1>{{ $count }}</h1>
                    <button wire:click="increment">+</button>
                    <button wire:click="decrement">-</button>
                </div>
            </div>
        </div>    
    </div>
</div>
