<li>
    <span style="text-decoration: {{ $task['completed'] ? 'line-through' : 'none' }}">
        {{ $task['title'] }}
    </span>
    @if (!$task['completed'])
        <button wire:click="markAsCompleted">Mark as Completed - {{  $task['completed'] }}</button>
    @else
        <span>(Completed)</span>
    @endif
</li>