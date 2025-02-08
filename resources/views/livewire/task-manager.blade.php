<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Task Manager</div>
                <div class="card-body">
                    <ul>
                        @foreach ($tasks as $task)
                            <?php
                            echo '<pre>';
                            print_r($task);
                            echo '</pre>';
                            
                            //this data is properly work completed status perfect work but "task-item" not fount completed status
                            
                            ?>
                            @livewire('task-item', ['task' => $task], key($task['id']))
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
